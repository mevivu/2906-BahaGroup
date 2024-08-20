<?php

namespace App\Api\V1\Services\Review;
use Illuminate\Http\Request;

interface ReviewServiceInterface
{


    public function filterReviews(Request $request);
    public function store(Request $request);
    public function index(Request $request);

}
