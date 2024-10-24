<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Setting\SettingTypeInput;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            // General
            [
                'setting_key' => 'site_name',
                'setting_name' => 'Tên site',
                'plain_value' => 'Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/user/assets/images/logo-ngang.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'info@bahagroup.vn',
                'type_input' => SettingTypeInput::Email,
                'group' => 1
            ],
            [
                'setting_key' => 'hotline',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0359777777',
                'type_input' => SettingTypeInput::Phone,
                'group' => 1
            ],
            [
                'setting_key' => 'site_logo_tab',
                'setting_name' => 'Logo tab',
                'plain_value' => '/public/user/assets/images/icon.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            // General Home
            [
                'setting_key' => 'home_title',
                'setting_name' => 'Tiêu đề trang chủ',
                'plain_value' => 'Trang chủ',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'home_meta_desc',
                'setting_name' => 'Thẻ meta description trang chủ',
                'plain_value' => 'Trang chủ - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            // General Information
            [
                'setting_key' => 'information_title',
                'setting_name' => 'Tiêu đề trang giới thiệu',
                'plain_value' => 'Giới thiệu',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'information_meta_desc',
                'setting_name' => 'Thẻ meta description trang giới thiệu',
                'plain_value' => 'Giới thiệu - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            // General Product
            [
                'setting_key' => 'product_title',
                'setting_name' => 'Tiêu đề trang sản phẩm',
                'plain_value' => 'Danh mục sản phẩm',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'product_meta_desc',
                'setting_name' => 'Thẻ meta description trang sản phẩm',
                'plain_value' => 'Danh mục sản phẩm - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            // General Contact
            [
                'setting_key' => 'contact_title',
                'setting_name' => 'Tiêu đề trang liên hệ',
                'plain_value' => 'Liên hệ',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'contact_meta_desc',
                'setting_name' => 'Thẻ meta description trang liên hệ',
                'plain_value' => 'Liên hệ - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            // General Sale
            [
                'setting_key' => 'sale_title',
                'setting_name' => 'Tiêu đề trang khuyến mãi',
                'plain_value' => 'Khuyến mãi giới hạn',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'sale_meta_desc',
                'setting_name' => 'Thẻ meta description trang khuyến mãi',
                'plain_value' => 'Khuyến mãi giới hạn - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            // General Post
            [
                'setting_key' => 'post_title',
                'setting_name' => 'Tiêu đề trang tin tức',
                'plain_value' => 'Tin tức',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'post_meta_desc',
                'setting_name' => 'Thẻ meta description trang tin tức',
                'plain_value' => 'Tin tức - Baha Office',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'title_home_slider_1',
                'setting_name' => 'Tiêu đề mục slider sản phẩm trang chủ 1',
                'plain_value' => 'Thiết bị công nghệ hàng đầu',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'title_home_slider_2',
                'setting_name' => 'Tiêu đề mục slider sản phẩm trang chủ 2',
                'plain_value' => 'Đồ gia dụng hiện đại',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'object_discount',
                'setting_name' => 'Mục tiêu để được miễn phí ship',
                'plain_value' => '3000000',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'image_home_slider_1',
                'setting_name' => 'Ảnh trưng bày mục slider sản phẩm trang chủ 1',
                'plain_value' => '/userfiles/images/banner-home2-04.jpg',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'image_home_slider_2',
                'setting_name' => 'Ảnh trưng bày mục slider sản phẩm trang chủ 2',
                'plain_value' => '/userfiles/images/img-slider-02-home2.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            // Footer
            [
                'setting_key' => 'footer_open_time',
                'setting_name' => 'Bán hàng',
                'plain_value' => '08h00 - 17h30',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_shop_phone',
                'setting_name' => 'Bán hàng',
                'plain_value' => '0359.777.777 (nhánh số 1)',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_office_phone',
                'setting_name' => 'Office',
                'plain_value' => '0359.777.777 (nhánh số 2)',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_warranty_phone',
                'setting_name' => 'Bảo hành',
                'plain_value' => '0359.777.777 (nhánh số 3)',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_email',
                'setting_name' => 'Hợp tác khiếu nại',
                'plain_value' => 'info@bahagroup.vn',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_address',
                'setting_name' => 'Địa chỉ',
                'plain_value' => '77 Bùi Tá Hán, An Phú, Thành phố Thủ Đức',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_banking_1',
                'setting_name' => 'Thông tin ngân hàng 1',
                'plain_value' => 'TECHCOMBANK: 87.87.87.87.87 - CN Thủ Đức - CÔNG TY CP TẬP ĐOÀN BAHA',
                'type_input' => SettingTypeInput::Ckeditor,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_banking_2',
                'setting_name' => 'Thông tin ngân hàng 2',
                'plain_value' => 'BIDV: 8696.777.777 - CN BẮC SÀI GÒN - CÔNG TY CP TẬP ĐOÀN BAHA',
                'type_input' => SettingTypeInput::Ckeditor,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_phone',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0359777777',
                'type_input' => SettingTypeInput::Phone,
                'group' => 4
            ],
            [
                'setting_key' => 'help_center',
                'setting_name' => 'Help Center',
                'plain_value' => 'http://localhost:8080/2906-BahaGroup',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'how_to_buy',
                'setting_name' => 'How to Buy',
                'plain_value' => 'http://localhost:8080/2906-BahaGroup',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'shipping_delivery',
                'setting_name' => 'Shipping & Delivery',
                'plain_value' => 'http://localhost:8080/2906-BahaGroup',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'product_policy',
                'setting_name' => 'Product Policy',
                'plain_value' => 'http://localhost:8080/2906-BahaGroup',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'how_to_return',
                'setting_name' => 'How to Return',
                'plain_value' => 'http://localhost:8080/2906-BahaGroup',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_social_1',
                'setting_name' => 'Facebook',
                'plain_value' => 'https://www.facebook.com/people/BaHa-Group/61559205100698/',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_social_2',
                'setting_name' => 'Linkedin',
                'plain_value' => 'https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            [
                'setting_key' => 'footer_social_3',
                'setting_name' => 'Tiktok',
                'plain_value' => 'https://www.tiktok.com/@baha_group_official',
                'type_input' => SettingTypeInput::Text,
                'group' => 4
            ],
            // Contact
            [
                'setting_key' => 'contact_messenger',
                'setting_name' => 'Messenger',
                'plain_value' => 'https://www.facebook.com/people/BaHa-Group/61559205100698/',
                'type_input' => SettingTypeInput::Text,
                'group' => 5
            ],
            [
                'setting_key' => 'contact_facebook',
                'setting_name' => 'Facebook',
                'plain_value' => 'https://www.facebook.com/people/BaHa-Group/61559205100698/',
                'type_input' => SettingTypeInput::Text,
                'group' => 5
            ],
            [
                'setting_key' => 'contact_zalo',
                'setting_name' => 'Zalo',
                'plain_value' => '0359777777',
                'type_input' => SettingTypeInput::Text,
                'group' => 5
            ],
            [
                'setting_key' => 'contact_phone',
                'setting_name' => 'Phone',
                'plain_value' => '0359777777',
                'type_input' => SettingTypeInput::Text,
                'group' => 5
            ],
            // Information
            [
                'setting_key' => 'infor_title',
                'setting_name' => 'Tiêu đề',
                'plain_value' => 'Bộ sưu tập phụ kiện điện tử và các sản phẩm công nghệ khác',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_content',
                'setting_name' => 'Nội dung',
                'plain_value' => 'Chất lượng là ưu tiên hàng đầu của chúng tôi, vì vậy bạn có thể yên tâm rằng bạn đang mua sắm những sản phẩm chính hãng và đáng tin cậy.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            // Information Card
            [
                'setting_key' => 'infor_card_title_1',
                'setting_name' => 'Tiêu đề thẻ 1',
                'plain_value' => 'Đa dạng sản phẩm',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_icon_1',
                'setting_name' => 'Icon thẻ 1',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_content_1',
                'setting_name' => 'Nội dung thẻ 1',
                'plain_value' => 'Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_title_2',
                'setting_name' => 'Tiêu đề thẻ 2',
                'plain_value' => 'Mua sắm trực tuyến',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_icon_2',
                'setting_name' => 'Icon thẻ 2',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_content_2',
                'setting_name' => 'Nội dung thẻ 2',
                'plain_value' => 'Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_title_3',
                'setting_name' => 'Tiêu đề thẻ 3',
                'plain_value' => 'Cam kết chất lượng',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_icon_3',
                'setting_name' => 'Icon thẻ 3',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_card_content_3',
                'setting_name' => 'Nội dung thẻ 3',
                'plain_value' => 'Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            // Information Vision
            [
                'setting_key' => 'infor_vision_content',
                'setting_name' => 'Nội dung tầm nhìn',
                'plain_value' => 'Bằng khát vọng tiên phong cùng chiến lược đầu tư - phát triển bền vững, BaHa đặt mục tiêu trở thành Tập đoàn truyền thông thương mại - marketing hàng đầu tại Việt Nam và vươn tầm khu vực Đông Nam Á. Trở thành đối tác tin cậy, chiến lược, mang đến cho khách hàng trải nghiệm tối ưu và mức độ hài lòng cao nhất.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_icon_1',
                'setting_name' => 'Icon tầm nhìn 1',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_text_1',
                'setting_name' => 'Nội dung tầm nhìn 1',
                'plain_value' => 'Nắm giữ vị trí dẫn đầu trong lĩnh vực cung cấp các sản phẩm và dịch vụ chất lượng cao.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_icon_2',
                'setting_name' => 'Icon tầm nhìn 2',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_text_2',
                'setting_name' => 'Nội dung tầm nhìn 2',
                'plain_value' => 'Đào tạo và xây dựng đội ngũ nhân viên năng động, có trình độ chuyên môn giỏi, tâm huyết với công việc.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_icon_3',
                'setting_name' => 'Icon tầm nhìn 3',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_text_3',
                'setting_name' => 'Nội dung tầm nhìn 3',
                'plain_value' => 'Xây dựng công ty với hệ thống quản trị khoa học, minh bạch, phát triển để trở thành một doanh nghiệp kinh doanh vững mạnh, an toàn.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_icon_4',
                'setting_name' => 'Icon tầm nhìn 4',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_vision_text_4',
                'setting_name' => 'Nội dung tầm nhìn 4',
                'plain_value' => 'Đảm bảo mọi sản phẩm - dịch vụ đều đạt chất lượng và hiệu quả cao nhất.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            // Information Mission
            [
                'setting_key' => 'infor_mission_slogan',
                'setting_name' => 'Khẩu hiệu sứ mệnh',
                'plain_value' => '"Đội ngũ tiên phong - Nâng tầm giá trị"',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_content',
                'setting_name' => 'Nội dung sứ mệnh',
                'plain_value' => '"Sứ mệnh của chúng tôi là tạo ra một đội ngũ tiên phong, không ngừng đổi mới và nâng cao giá trị, đem lại sự khác biệt cho khách hàng và cộng đồng,mang lại những trải nghiệm và thành công vượt bậc."',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_icon_1',
                'setting_name' => 'Icon sứ mệnh 1',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_text_1',
                'setting_name' => 'Nội dung sứ mệnh 1',
                'plain_value' => 'BaHa đề cao tinh thần cầu tiến, mỗi thành viên trong tập thể cam kết cải tiến 1% mỗi ngày. Chúng tôi không ngừng nâng cao chất lượng dịch vụ, hoàn thiện từng khâu nhỏ để mang đến trải nghiệm hoàn hảo cho khách hàng.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_icon_2',
                'setting_name' => 'Icon sứ mệnh 2',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_text_2',
                'setting_name' => 'Nội dung sứ mệnh 2',
                'plain_value' => 'BaHa hướng đến xây dựng một môi trường làm việc văn minh, đề cao giá trị đạo đức và văn hóa doanh nghiệp. Mỗi hành trình mua sắm tại BaHa đều mang đến cho khách hàng trải nghiệm TỐT, sự hài lòng và ấn tượng sâu sắc.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_icon_3',
                'setting_name' => 'Icon sứ mệnh 3',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_mission_text_3',
                'setting_name' => 'Nội dung sứ mệnh 3',
                'plain_value' => 'Mong muốn tạo ra sự khác biệt so với các đối thủ cạnh tranh, trở thành thương hiệu được khách hàng tin tưởng và yêu thích.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            // Information Value
            [
                'setting_key' => 'infor_value_content',
                'setting_name' => 'Nội dung giá trị cốt lõi',
                'plain_value' => 'Baha Group xác định Tâm - Trí - Nhân - Tín - Tiến - Chất là kim chỉ nam cho mọi hoạt động, là nền tảng đạo đức và trí tuệ vững chắc cho sự phát triển bền vững.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_sub_content',
                'setting_name' => 'Nội dung phụ giá trị cốt lõi',
                'plain_value' => 'Giá trị cốt lõi của Baha Group:',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_1',
                'setting_name' => 'Icon giá trị 1',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_1',
                'setting_name' => 'Tiêu đề giá trị 1',
                'plain_value' => 'TÂM',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_1',
                'setting_name' => 'Nội dung giá trị 1',
                'plain_value' => 'Cống hiến hết mình, tận tâm với công việc để đạt được mục tiêu và mang lại giá trị đích thực cho khách hàng và đối tác. Hành động với tinh thần nhân văn, đề cao sự tôn trọng và hỗ trợ lẫn nhau.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_2',
                'setting_name' => 'Icon giá trị 2',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_2',
                'setting_name' => 'Tiêu đề giá trị 2',
                'plain_value' => 'TRÍ',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_2',
                'setting_name' => 'Nội dung giá trị 2',
                'plain_value' => 'Sử dụng trí tuệ và sự sáng tạo để giải quyết các vấn đề và đưa ra các giải pháp tối ưu.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_3',
                'setting_name' => 'Icon giá trị 3',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_3',
                'setting_name' => 'Tiêu đề giá trị 3',
                'plain_value' => 'NHÂN',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_3',
                'setting_name' => 'Nội dung giá trị 3',
                'plain_value' => 'Đề cao giá trị con người, xây dựng đội ngũ nhân viên năng động, có trình độ chuyên môn giỏi, tâm huyết với công việc.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_4',
                'setting_name' => 'Icon giá trị 4',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_4',
                'setting_name' => 'Tiêu đề giá trị 4',
                'plain_value' => 'TÍN',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_4',
                'setting_name' => 'Nội dung giá trị 4',
                'plain_value' => 'Giữ chữ tín với khách hàng và đối tác, luôn hành động đúng cam kết.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_5',
                'setting_name' => 'Icon giá trị 5',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_5',
                'setting_name' => 'Tiêu đề giá trị 5',
                'plain_value' => 'TIẾN',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_5',
                'setting_name' => 'Nội dung giá trị 5',
                'plain_value' => 'Luôn tiến lên, không ngừng cải tiến và phát triển để đạt được những thành tựu mới.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_icon_6',
                'setting_name' => 'Icon giá trị 6',
                'plain_value' => 'ti ti-phone',
                'type_input' => SettingTypeInput::Icon,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_title_6',
                'setting_name' => 'Tiêu đề giá trị 6',
                'plain_value' => 'CHẤT',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_value_text_6',
                'setting_name' => 'Nội dung giá trị 6',
                'plain_value' => 'Đảm bảo chất lượng trong mọi sản phẩm và dịch vụ, mang lại sự hài lòng cao nhất cho khách hàng.',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            // Information Achievement
            [
                'setting_key' => 'infor_achievement_content',
                'setting_name' => 'Nội dung thành tựu',
                'plain_value' => 'Khám phá tận hưởng tiện lợi và sự đa dạng của mua sắm trực tuyến',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_1',
                'setting_name' => 'Số liệu thành tựu 1',
                'plain_value' => '1,000+',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_1',
                'setting_name' => 'Nội dung thành tựu 1',
                'plain_value' => 'Thương hiệu nổi tiếng',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_2',
                'setting_name' => 'Số liệu thành tựu 2',
                'plain_value' => '95%',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_2',
                'setting_name' => 'Nội dung thành tựu 2',
                'plain_value' => 'Khách hàng hoàn toàn hài lòng',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_3',
                'setting_name' => 'Số liệu thành tựu 3',
                'plain_value' => '99+',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_3',
                'setting_name' => 'Nội dung thành tựu 3',
                'plain_value' => 'Danh mục sản phẩm nổi bật',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_4',
                'setting_name' => 'Số liệu thành tựu 4',
                'plain_value' => '131,000+',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_4',
                'setting_name' => 'Nội dung thành tựu 4',
                'plain_value' => 'Đơn hàng đã được đặt',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_5',
                'setting_name' => 'Số liệu thành tựu 5',
                'plain_value' => '200,000+',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_5',
                'setting_name' => 'Nội dung thành tựu 5',
                'plain_value' => 'Sản phẩm công nghệ hàng đầu',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_stat_6',
                'setting_name' => 'Số liệu thành tựu 6',
                'plain_value' => '39%',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'infor_achievement_text_6',
                'setting_name' => 'Nội dung thành tựu 6',
                'plain_value' => 'Lợi nhuận hàng năm tăng trưởng',
                'type_input' => SettingTypeInput::Text,
                'group' => 6
            ],
            [
                'setting_key' => 'slider_image_4',
                'setting_name' => 'Ảnh dưới slider 1',
                'plain_value' => '/userfiles/images/banner-home2-01.jpg',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'slider_image_5',
                'setting_name' => 'Ảnh dưới slider 2',
                'plain_value' => '/userfiles/images/banner-home2-02222.jpg',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
        ]);
    }
}
