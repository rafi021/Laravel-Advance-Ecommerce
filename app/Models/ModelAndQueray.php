<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
//Query Builder
//in Eloquent

//Select
// جلب البيانات و سلكت تستخدم لتحديد عدد الاعمدة معينة
DB::table('users')->select('name','email')->get();
User::select('name','email')->get();
//Distinct
//تستخدم لجلب القيم غير متكررة
DB::table('users')->distinct()->get();
User::distinct()->get();
//Pluck
//لاسترجاع قائمة بقيم عمود معين على شكل مصفوفة
DB::table('users')->pluck('name');
User::pluck('name');
//GroupBy
//تستخدم لتجميع السجلات  بناء على قيمة عمود معين
DB::table('users')->groupBy('status')->get();
User::groupBy('status')->get();
//Join
//تستخدم لربط جدولين عند توفر شرط مشترك
DB::table('users')->join('orders','users.id','=','orders.id')->get();
User::join('orders','users.id','=','orders.id')->get();
//Insert
//تستخدم لاضافة البيانات جديدة
DB::table('users')->insert(['name' =>'hamdy']);
//بعد اضافة البيانات يرجع المعرف مباشرة
DB::table('users')->insertGetId(['name' =>'hamdy']);
//بعد عملية اضافة يتم الوصول لمودل كامل
User::create(['name' =>'hamdy']);
//offset() ,skip() || offset(), take()
//لتخطى عدد معين من البيانات
DB::table('users')->offset(10)->limit(5)->get();
User::skip(10)->take(5)->get();

