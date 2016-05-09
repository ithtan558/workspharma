<div class="products">

    <div class="body">

    <?php

    $stt=1;

	if(count($listProducts)>0){

		foreach($listProducts as $products)

		{

			?>

			<div class="only-products <?php if($stt>=3 && $stt%3==0) echo ' right';?>">

				<div class="thumb_products">

					<div class="body-thumb_products"><a title="<?php echo $products->name_products?>" href="<?php echo URL.$products->alias_products_categories.'/'.$products->catid.'/'.$products->idProducts.'/'.$products->alias_products;?>"><img alt="<?php echo $products->name_products?>" 
					width="<?php

					foreach($getProductsConfig as $productsConfig){

						if($productsConfig->name_modules_config=='thumb_width')

						{

							echo $productsConfig->value_modules_config;

						}

					}

					?>" 

					 height="<?php

					foreach($getProductsConfig as $productsConfig){

						if($productsConfig->name_modules_config=='thumb_height')

						{

							echo $productsConfig->value_modules_config;

						}

					}

					?>"

					src="<?php 
						if($products->thumb_products!="")
						{
							echo IMAGES.'products/'.$products->thumb_products;
						}
						else
						{
							echo IMAGES.'products/thumb_default.jpg';
						}
					?>" /></a></div>

					<!--<div class="sale-new-product">

						<?php

						if($products->is_sale_products!="")

						{

							?>

							<div class="sale"><span ><?php echo sale;?></span></div>

							<?php

						}

						if($products->is_new_products!="")

						{

							?>

							<div  class="new"><span><?php echo news;?></span></div>

							<?php

						}

						?>

					</div>-->

				</div>

				<div class="description_products">

					<h3 class="title-h3"><a href="<?php echo URL.$products->alias_products_categories.'/'.$products->catid.'/'.$products->idProducts.'/'.$products->alias_products;?>"><?php echo $products->name_products?></a></h3>

					<span><?php echo $products->code_products?></span>

				</div>

			</div>

		<?php

		$stt++;

		}

	}

    ?>

	</div>

</div>