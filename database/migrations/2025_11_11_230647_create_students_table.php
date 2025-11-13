<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('full_name'); // সম্পূর্ণ নাম
            $table->string('fathers_name')->nullable(); // পিতার নাম
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // লিঙ্গ
            $table->date('date_of_birth')->nullable(); // জন্ম তারিখ

            // Contact Info
            $table->string('email')->unique()->nullable(); // ইমেইল
            $table->string('mobile_number')->nullable(); // মোবাইল
            $table->string('alternate_number')->nullable(); // ২য় যোগাযোগ নম্বর
            $table->string('emergency_contact')->nullable(); // জরুরী যোগাযোগ নম্বর
            $table->string('facebook_id')->nullable(); // ফেসবুক আইডি

            // Address Info
            $table->text('present_address')->nullable(); // বর্তমান ঠিকানা
            $table->string('present_division')->nullable(); // বর্তমান বিভাগ
            $table->string('country_name')->nullable(); // দেশ
            $table->text('permanent_address')->nullable(); // স্থায়ী ঠিকানা

            // Identity & Education
            $table->string('nid_or_birth_certificate')->nullable(); // জাতীয় পরিচয়পত্র/জন্মসনদ
            $table->string('present_occupation')->nullable(); // বর্তমান পেশা
            $table->string('educational_qualification')->nullable(); // শিক্ষাগত যোগ্যতা
            $table->string('last_institution')->nullable(); // সর্বশেষ প্রতিষ্ঠান
            $table->string('studied_subject')->nullable(); // ডিপার্টমেন্ট

            // Islamic Study Background
            $table->boolean('studied_islamic_institution')->nullable(); // ইসলামিক বিষয়ে পড়েছেন কিনা
            $table->string('school_of_thought')->nullable(); // মাযহাব

            // Course Info
            $table->enum('class_device', ['computer', 'mobile'])->nullable(); // ক্লাস করার ডিভাইস
            $table->string('admission_for')->nullable(); // ভর্তি কোর্স
            $table->json('selected_courses')->nullable(); // একাধিক কোর্স (JSON array)

            // Payment Info
            $table->string('payment_method')->nullable(); // পেমেন্ট মাধ্যম
            $table->decimal('payment_amount', 10, 2)->nullable(); // মোট টাকা
            $table->string('transaction_id')->nullable(); // ট্রান্জেকশন আইডি
            $table->string('order_id')->nullable(); // অর্ডার আইডি

            // Reference Info
            $table->string('know_about_iom')->nullable(); // IOM সম্পর্কে জানার মাধ্যম
            $table->string('reference')->nullable(); // রেফারেন্স

            // Agreements
            $table->boolean('accepted_terms')->default(false); // Admission Policy & Terms & Conditions

            // Old fields (optional, if still needed)
            $table->string('roll')->unique()->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
