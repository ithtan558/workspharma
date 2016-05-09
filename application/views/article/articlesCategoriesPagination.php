<table>
    <tbody>
        <?php
        if($listArticlesCategories[0]->alias_articles_categories=='gioi-thieu')
        {
            $fulltext_articles=$listArticlesCategories[0]->fulltext_articles;
            $fulltext_articles=str_replace('public/',''.URL.'public/'.'',$fulltext_articles);
            $fulltext_articles=str_replace(URL.URL.'public/',''.URL.'public/'.'',$fulltext_articles);
            echo $fulltext_articles;
        }
        else
        {
            foreach($listArticlesCategories as $articlesCategories)
            {
                
                ?>
                <tr>
                    <td width="6%" valign="top" style="padding:0px 10px 10px 0px">
                        <a title="<?php echo $articlesCategories->title_articles;?>" href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>">
                            <img src="<?php echo IMAGES.'articles/'.$articlesCategories->thumb_articles;?>" border="0" width="100px" height="75px" alt="<?php echo $articlesCategories->title_articles;?>">
                        </a>
                    </td>
                    <td width="94%" colspan="2" valign="top">
                        <div><a title="<?php echo $articlesCategories->title_articles;?>" href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>"><strong><?php echo $articlesCategories->title_articles;?></strong></a>
                        </div>
                        <div class=""><?php echo $articlesCategories->introtext_articles;?></div>
                        <div style="float:right"><a title="<?php echo $articlesCategories->title_articles;?>" href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>">Xem tiếp 	»	</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div style="border-top:dotted 1px #333333; width:100%; padding-bottom:10px"></div>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        
    </tbody>
</table>
<?php
if($listArticlesCategories[0]->alias_articles_categories!='gioi-thieu')
{
	?>
	<table align="center">
		<tbody>
			<tr>
				<td align="center">
					<div align="center">
						<div id="paging" class="jquery_link_articles" align="center">
							<?php echo $pagination_listArticles;?>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
?>