<?php

namespace Database\Seeders;

use App\Models\CMS\Banner;
use App\Models\CMS\Category;
use App\Models\CMS\Comment;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\Faq;
use App\Models\CMS\Member;
use App\Models\CMS\News;
use App\Models\CMS\Page;
use App\Models\CMS\Icon;
use App\Models\CMS\Post;
use App\Models\CMS\ProjectType;
use App\Models\CMS\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        ProjectType::factory(3)->create();

//         Category::factory(10)->create();
//        Page::factory(3)->create();
//        Service::factory(10)->create();
//        CompanyProject::factory(10)->create();
//        Partner::factory(3)->create();
//        Banner::factory(10)->create();


//        Post::factory(10)->has(Comment::factory()->count(3),'comments')->create();
//        Faq::factory(3)->create();

//        News::factory(10)->create();
//        Member::factory(10)->create();


//        $companyProjects = CompanyProject::take(10)->get();
//        $services = Service::take(10)->get();
//        $companyProjects->each(function($companyProject) use ($services) {
//            $companyProject->services()->attach($services->random(3),['zone'=>Str::random(30)]);
//        });

    }
}
