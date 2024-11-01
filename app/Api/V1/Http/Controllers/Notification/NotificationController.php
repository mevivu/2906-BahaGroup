<?php

namespace App\Api\V1\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Paginate\PaginateRequest;
use App\Api\V1\Http\Resources\Notification\NotificationResource;
use App\Api\V1\Http\Resources\Notification\NotificationDetailResource;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Support\Response;
use App\Enums\Notification\NotificationStatus;
use Illuminate\Http\JsonResponse;

/**
 * @group Thông báo
 */

class NotificationController extends Controller
{
    use Response;

    protected NotificationRepositoryInterface $notiRepository;
    protected UserRepositoryInterface $userRepository;

    public function __construct(
        NotificationRepositoryInterface $repository,
        UserRepositoryInterface         $userRepository,

    ) {
        $this->notiRepository = $repository;
        $this->userRepository = $userRepository;
    }
    /**
     * Chi tiết thông báo
     *
     * Lấy chi tiết thông báo.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id thông báo. Example: 1 | cat-1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 4,
     *          "title": "TEST GỬI THÔNG BÁO",
     *          "message": "TEST GỬI THÔNG BÁO",
     *          "status": "Đã đọc",
     *          "created_at": "2024-10-30T11:22:03+07:00"
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id): JsonResponse
    {
        $note = $this->notiRepository->find($id);
        if ($note) {
            $note->markAsRead($id);
        }

        if (!$note) {
            return response()->json(['status' => 404, 'message' => 'Không tìm thấy'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new NotificationDetailResource($note),
        ]);
    }
    /**
     * Danh sách thông báo của người dùng
     *
     * Lấy danh sách thông báo của người dùng.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 4,
     *              "title": "TEST GỬI THÔNG BÁO",
     *              "message": "TEST GỬI THÔNG BÁO",
     *              "status": "Đã đọc",
     *              "created_at": "2024-10-30T11:22:03+07:00"
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserNotifications(PaginateRequest $request): JsonResponse
    {
        $userId = auth('sanctum')->user()->id;
        $notifications = $this->notiRepository->getUserNotifications($userId, $request);

        if ($notifications->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'Không tìm thấy'], 404);
        }

        return $this->jsonResponseSuccess(new NotificationResource($notifications));
    }

    /**
     * Đọc tất cả thông báo
     *
     * Dùng để đọc tất cả thông báo.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAllStatusRead(): JsonResponse
    {
        $userId = auth('sanctum')->user()->id;
        $criteria = [
            'status' => NotificationStatus::NOT_READ,
            'user_id' => $userId,
        ];
        $notifications = $this->notiRepository->getBy($criteria);
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return $this->jsonResponseSuccess(null);
    }
}
