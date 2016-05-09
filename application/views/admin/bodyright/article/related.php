<?php $this->load->view("admin/script");?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	oTable = $('.datatables1').dataTable({
		"scrollY":        "340px",
        "scrollCollapse": true,
        "bJQueryUI": true,
		"sPaginationType": "full_numbers",
		'iDisplayLength': -1
	});
});
</script>
    <form class="" action="<?php echo base_url();?>admin/article/removeArticle" method="post" id="from-admin">
        <table class="TableGrid datatables1" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã bài viết </th>
                    <th width="10%">Loại</th>
                    <th width="10%">Tên bài viết </th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="button" class="btn" name="btnChon" id="btnChon">
                            <span>Chọn</span>
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody >
				<?php
                $stt=0;
                $total_row=count($listArticle);
                foreach ($listArticle as $row)
                {	
                ?>
                <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                    <td  width="5%"><?php echo $stt+1?></td>
                    <td  width="10%" ><?php echo $row->idArticles?></td>
                    <td  width="10%" ><?php echo $row->name_articles_categories?></td>
                    <td  width="10%" ><?php echo $row->title_articles?></td>
                    <td width="15%">
                        <input type="checkbox" name="delete[]" value="<?php echo $row->idArticles;?>" />   
                    </td>
                </tr>
              <?php 
              $stt++;
              }
              ?>
          </tbody>
    	</table>
        <!--data id -->
        <input type="hidden" name="catid" value="" id="catid">
        <!--data idsub -->
        <input type="hidden" name="t" value="" id="t">
        <!--data stt -->
        <input type="hidden" name="stt" value="" id="stt">
    </form>
   <!-- <script type="text/javascript">
	$(document).ready(function(e) {
        $("#them_hoadon").click(function(e){
			window.open("","_self");
		})
    });
	</script>-->
<style>
#tbl_danhsachhoadon_wrapper{
	width:100% !important;
	height:100% !important;
}
</style>
<script>
$(document).ready(function(e) {
	$("#btnChon").click(function(e){
		e.preventDefault();
		var string=null;
		var selectedGroups  = new Array();
			$("input[name='delete[]']:checked").each(function() {
			selectedGroups.push($(this).val());
		});
		var number  = new Array();
		$("#related_pro option",window.parent.document).each(function()
		{
			number.push($(this).val());
		});
		window.parent.$.ajax({
        url: '<?php echo URL.'admin/article/add_related';?>',
        async: false,   // this is the important line that makes the request sincronous
        type: 'post',
		data: {selectedGroups:selectedGroups,
			number:number},
        dataType: 'json', 
        success: function(output) {
			string = output.result;
		 }});
		$("#related_pro",window.parent.document).append(string);
		parent.$("#popup2").bPopup().close();
	});  
	  
});

</script>