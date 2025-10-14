to start the project -> php artisan serve

to use API on laravel

লারাভেলে একটি API তৈরি করতে এন্ডপয়েন্ট নির্ধারণ, অনুরোধ পরিচালনা এবং ডেটা ফেরত দেওয়ার জন্য বেশ কয়েকটি গুরুত্বপূর্ণ ধাপ জড়িত।
১. প্রকল্প সেটআপ (যদি নতুন প্রকল্প শুরু করেন):
যদি ইতিমধ্যেই করা না থাকে, তাহলে একটি নতুন লারাভেল প্রকল্প তৈরি করুন:
Code

laravel new YourApiProject
cd YourApiProject
২. API সক্ষমতা ইনস্টল করুন (Laravel ১১+):
Laravel 11 এবং তার পরবর্তী সংস্করণের জন্য, API কার্যকারিতা আর ডিফল্টরূপে অন্তর্ভুক্ত থাকে না। এটি ব্যবহার করে ইনস্টল করুন:
Code

php artisan install:api
এই কমান্ডটি প্রমাণীকরণের জন্য Laravel Sanctum ইনস্টল করে এবং routes/api.php ফাইল তৈরি করে, যেখানে আপনার API রুটগুলি থাকবে। এটি ভবিষ্যতের প্রমাণীকরণের জন্য আপনার ব্যবহারকারী মডেলেHasApiTokens বৈশিষ্ট্যও যোগ করে।
৩. একটি কন্ট্রোলার তৈরি করুন:
কন্ট্রোলাররা ইনকামিং API অনুরোধগুলি পরিচালনা করে এবং প্রতিক্রিয়াগুলি ফেরত দেয়। আপনার API রিসোর্সের জন্য একটি নতুন কন্ট্রোলার তৈরি করুন:
Code

php artisan make:controller Api/YourResourceController --api
--api ফ্ল্যাগটি সাধারণ CRUD ক্রিয়াকলাপের (সূচক, সঞ্চয়, প্রদর্শন, আপডেট, ধ্বংস) পদ্ধতি সহ একটি রিসোর্স কন্ট্রোলার তৈরি করে।
৪. API রুট সংজ্ঞায়িত করুন:
routes/api.phpফাইলটি খুলুন এবং আপনার API এন্ডপয়েন্টগুলি সংজ্ঞায়িত করুন। সুবিধার জন্য আপনি রিসোর্স রুট ব্যবহার করতে পারেন: 
Code

// routes/api.php

use App\Http\Controllers\Api\YourResourceController;

Route::apiResource('your-resource', YourResourceController::class);
এই একক লাইনটি your-resourceতে সমস্ত স্ট্যান্ডার্ড CRUD ক্রিয়াকলাপের জন্য রুট নির্ধারণ করে । কাস্টম রুটের জন্য, আপনি সেগুলিকে পৃথকভাবে সংজ্ঞায়িত করতে পারেন:
Code

Route::get('/custom-endpoint', [YourResourceController::class, 'customMethod']);
৫. কন্ট্রোলার লজিক বাস্তবায়ন করুন:
তোমার Api/YourResourceController.phpএ , প্রতিটি পদ্ধতির জন্য লজিক প্রয়োগ করো (যেমন, index, store, show, update, destroy, এবং যেকোনো কাস্টম পদ্ধতি)। এর মধ্যে আপনার মডেলগুলির সাথে ইন্টারঅ্যাক্ট করা, অনুরোধগুলি যাচাই করা এবং ডেটা ফেরত দেওয়া জড়িত, সাধারণত JSON হিসাবে:
Code

// app/Http/Controllers/Api/YourResourceController.php

use App\Models\YourResource;
use Illuminate\Http\Request;

class YourResourceController extends Controller
{
    public function index()
    {
        $resources = YourResource::all();
        return response()->json($resources);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // ... other validation rules
        ]);

        $resource = YourResource::create($validatedData);
        return response()->json($resource, 201); // 201 Created
    }

    // ... other methods like show, update, destroy
}
৬. মডেল এবং মাইগ্রেশন তৈরি করুন (প্রয়োজনে):
যদি আপনার API একটি ডাটাবেসের সাথে ইন্টারঅ্যাক্ট করে, তাহলে আপনার রিসোর্সের জন্য মডেল এবং মাইগ্রেশন তৈরি করুন:
Code

php artisan make:model YourResource -m
তারপর, মাইগ্রেশন ফাইলে আপনার টেবিল স্কিমা সংজ্ঞায়িত করুন এবং এটি চালান:
Code

php artisan migrate
৭. আপনার API পরীক্ষা করুন:
আপনার API এন্ডপয়েন্টগুলিতে অনুরোধ পাঠাতে Postman, Insomnia, অথবা cURL এর মতো টুল ব্যবহার করুন (যেমন, http://localhost:8000/api/your-resource)। আপনার ক্লায়েন্ট তার অনুরোধগুলিতেএকটি Accept: application/json হেডার পাঠাবে তা নিশ্চিত করুন। 
ঐচ্ছিক: API রিসোর্স:
JSON প্রতিক্রিয়াগুলির উপর আরও নিয়ন্ত্রণের জন্য, আপনার Eloquent মডেলগুলিকে রূপান্তর এবং ফর্ম্যাট করতে Laravel API রিসোর্সগুলি ব্যবহার করার কথা বিবেচনা করুন:
Code

php artisan make:resource YourResourceResource
তারপর, এটি আপনার নিয়ামকটিতে ব্যবহার করুন:
Code

use App\Http\Resources\YourResourceResource;

public function show(YourResource $yourResource)
{
    return new YourResourceResource($yourResource);
}