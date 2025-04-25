<?php

namespace App\Imports;

use Auth;
use Str;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportProduct implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function collection(Collection $rows)
    {
		$c = 0;
        foreach ($rows as $row) 
        {
			if($c != 0){
				if($row[0] != ''){
					$name = trim($row[0]);
					$slug = Str::slug($name);
					
					$product = new Product();
					$product->user_id = Auth::user()->id;
					$product->name = $name;
					$product->slug = $slug;
					$product->category_id = $row[1];
					$product->sub_category_id = $row[2];
					$product->sub_category2_id = $row[3];
					$product->price = $row[4];
					$product->brand = $row[5];
					$product->quantity = $row[6];
					$product->description = $row[7];
					$product->short_description = $row[8];
					$product->additional_information = $row[9];
					$product->SEO_description = $row[10];
					$product->SEO_tags = $row[11];
					$product->is_variants = $row[12];
					$product->is_replacement = $row[13];
					$product->replacement_days = $row[14];
					$product->is_tax_applicable = $row[15];
					$product->igst = $row[16];
					$product->cgst = $row[17];
					$product->sgst = $row[18];
					$product->status = $row[19];
					$product->save();
				}
			}
			$c++;
        }
    }
}
