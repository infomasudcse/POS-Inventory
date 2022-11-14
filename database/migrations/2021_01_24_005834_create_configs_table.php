<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->integer('id')->default(1);
            $table->string('business_name')->default('My Company');
            $table->string('owner_name')->default('Md Masud');
            $table->string('address')->default('Dhaka, Bangladersh');
            $table->string('contact')->default('0088 0123456789');
            $table->string('email')->default('admin@business.com');
            $table->string('slogan')->default('company slogan here');
            $table->text('return_policy');
            $table->text('memo_header');
            $table->float('default_tax', 8, 2)->default(1.00);
            $table->string('default_tax_name')->default('VAT');
            $table->string('branch_qty')->default(3);
            $table->tinyInteger('autobarcode')->default(0);
            $table->tinyInteger('br_line')->default(1);
            $table->tinyInteger('ecommerce')->default(0);
            $table->string('logo',30)->default('logo.png');
            $table->string('mono',30)->default('mono.png');
            $table->float('corporate_multiply', 3, 2)->default(1.00);
            $table->string('support',30)->default('MaxDigital.live');
            $table->string('support_link',50)->default('http://maxdigital.live'); 
            $table->string('support_contact',30)->default('01763036764');   
            $table->timestamps();
        });

        DB::table('configs')->insert([
            'business_name'=>'My Company',
            'return_policy'=>'Return policy here',
            'memo_header'=>'...',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
