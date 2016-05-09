<?php echo $this->load->view('search/mainResume'); ?>
<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="my_job">
                    <!-- <div class="title_header">
                        <h3><?php echo $this->lang->line('Result find resume');?></h3>
                    </div> -->
                    <div class="body_mo">
                        <div class="row">
                        	<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom no-padding">
                        		<div class="col-md-8 col-sm-4 col-xs-12 no-padding" style="float: right;">
                        			<div class="col-md-4 col-sm-6 col-xs-6 no-padding" style="float: right;">
                        				<select class="form-control" id="box_sort_change_salary">
		                        			<option value="">-- <?php echo $this->lang->line('Salary'); ?></option>
		                        			<?php
                                            foreach ($default_salary as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>" <?php if(isset($salary))if($salary==$key)echo 'selected="selected"'; ?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
										</select>
										<?php echo $this->lang->line('Million'); ?>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-6 no-padding-right" style="float: right;">
										<select name="year_exp" class="form-control" id="box_sort_change_experience">
                                            <option value="">-- <?php echo $this->lang->line('Experience')?> --</option>
                                            <?php
                                            $default_exp = $this->config->item('default_exp');
                                            foreach($default_exp as $key => $value){
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php if(isset($experience))if($experience==$key)echo 'selected="selected"'; ?>><?php echo $value; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
		                        	</div>
	                        		<div class="col-md-4 col-sm-6 col-xs-6 no-padding padding-top-8 padding-right-10" style="float: right; text-align: right;">
		                        		<span><?php echo $this->lang->line('Fillter resume'); ?></span>
		                        	</div>
		                        </div>
	                        </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ho-so">
                                <div class="ho-so-xin-viec row">
                                    <div class="col-sm-12">
                                        <div class="row app-panel" id="my-jobs">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-projects row" id="reload-status-project">
													<table class="table col-lg-12 table col-md-12 col-sm-12 col-xs-12 no-padding table-dashboard">
													    <thead>
														    <tr class="x8-16-b">
														        <td class="col-lg-4"><?php echo $this->lang->line("Applicants") ?></td>
														        <td class="col-lg-2" align="center"><?php echo $this->lang->line("Experience") ?></td>
														        <td class="col-lg-2" align="center"><?php echo $this->lang->line("Salary") ?></td>
														        <td class="col-lg-1" align="center"><?php echo $this->lang->line("Address") ?></td>
														        <td class="col-lg-1" align="right"><?php echo $this->lang->line("Fillter resume") ?></td>
														    </tr>
													    </thead>
													    <tbody>
													    <?php
													    	if(isset($resumes))
															{
																if ($resumes->num_rows() > 0) {
													        		foreach ($resumes->result() as $item) {
														            ?>
														            <tr>
														                <td><a target="_blank" class="title" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_view_resume').'/?idResume='.$this->encrypt->encode($item->rid); ?>"><?php echo $item->title ?></a></td>
														                <td align="center"><?php echo $default_exp[$item->yearOfExperience]?></td>
														                <td align="center"><?php echo get_salary($item->expected_salary); ?></td>
														                <td align="center"><?php echo get_city($item->city); ?></td>
														                <td align="right"><?php echo date('d-m-Y',$item->rdate_created);?></td>
														            </tr>
															        <?php
															        }
															    }
															    else{
		                                                            echo '<tr><td> - </td>
		                                                            <td> - </td>
		                                                            <td align="center"> - </td>
		                                                            <td align="center"> - </td>
		                                                            <td align="right"> - </td></tr>';
		                                                        }
															}
													    ?>
													    </tbody>
													</table>
                                                    <div class="dashboard-pagination text-right col-lg-12 col-md-12 col-sm-12 no-padding">
                                                        <?php if (isset($pagination)) echo $pagination; ?>
                                                    </div>
                                                    <!-- freelancer pagination -->
                                                </div>
                                                <!-- table-list-project -->
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- ho-so-xin-viec-->
                            </div>
                        </div> <!--row-->
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->
<script type="text/javascript">
	$(document).ready(function() {
		
		$('body').on('change','#box_sort_change_salary',function(){
	        var url = '<?php echo current_url_temp1(); ?>';
	        var value = $('option:selected',this).val();
	        $.ajax({
	            type : "POST",
	            url : url,
	            data : {salary:value},
	            beforeSend: function(){
	                $(".body").attr("disabled", 'disabled').before('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
	            },
	            success:function(data){
	                var res= $.parseJSON(data);
	                window.open(res.url,'_self')
	            }
	        });
	    });

	    
		$('body').on('change','#box_sort_change_experience',function(){
	        var url = '<?php echo current_url_temp1(); ?>';
	        var value = $('option:selected',this).val();
	        $.ajax({
	            type : "POST",
	            url : url,
	            data : {experience:value},
	            beforeSend: function(){
	                $(".body").attr("disabled", 'disabled').before('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
	            },
	            success:function(data){
	                var res= $.parseJSON(data);
	                window.open(res.url,'_self')
	            }
	        });
	    });
	});
</script>