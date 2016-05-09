<script>
	$(document).ready(function(e) {
		
		$("#insert_related_articles").live("click",function(e){
			e.preventDefault();
			$('#popup2').bPopup({
				content:'iframe', //'ajax', 'iframe' or 'image'
				contentContainer:'.content',
				loadUrl:'<?php echo URL.'admin/article/related'?>' //Uses jQuery.load()
			});
		})  
    });
	
	function combo_MoveUp(combo)
{ 
	var c = document.getElementById(combo);
	i=c.selectedIndex;
	if (i>0)
	{
		combo_swap(combo,i,i-1);
		c.options[i-1].selected=true;
		c.options[i].selected=false;
	}
}

function combo_MoveDown(combo)
{
	var c = document.getElementById(combo);
	i=c.selectedIndex;

	if (i<c.length-1 && i>-1)
	{
		combo_swap(combo,i+1,i);
		c.options[i+1].selected=true;
		c.options[i].selected=false;
	}
}

//this function is used to swap between elements
function combo_swap(combo,index1, index2)
{
	combo = document.getElementById(combo);
	var savedValue=combo.options[index1].value;
	var savedText=combo.options[index1].text;

	combo.options[index1].value=combo.options[index2].value;
	combo.options[index1].text=combo.options[index2].text;

	combo.options[index2].value=savedValue;
	combo.options[index2].text=savedText;
}

function combo_MoveToTop(combo)
{
	var c = document.getElementById(combo);
	i=c.selectedIndex;
	
	for (;i>0;i--)
	{
		combo_swap(combo,i,i-1);
		c.options[i-1].selected=true;
		c.options[i].selected=false;
	}
}

function combo_MoveToBottom(combo)
{
	var c = document.getElementById(combo);
	i=c.selectedIndex;
	
	if (i>-1)
	{
		for (;i<c.length-1;i++)
		{
			combo_swap(combo,i+1,i);
			c.options[i+1].selected=true;
			c.options[i].selected=false;
		}
	}
}

//moves options from one selection box (combo box) to another
//removes the all selected options from one combo box and adds them to the second combo box
function combo_MoveElements(FromCombo,ToCombo)
{
	var FromCombo = document.getElementById(FromCombo);
	var ToCombo = document.getElementById(ToCombo);
	var to_remove_counter=0; //number of options that were removed (num selected options)

	//move selected options to right select box (to)
	for (var i=0;i<FromCombo.options.length;i++)
	{
		if (FromCombo.options[i].selected==true)
		{
			var addtext=FromCombo.options[i].text;
			var addvalue=FromCombo.options[i].value;
			ToCombo.options[ToCombo.options.length]=new Option(addtext,addvalue);
			FromCombo.options[i].selected=false;
			++to_remove_counter;
		}
		else
		{
			FromCombo.options[i-to_remove_counter].selected=false;
			FromCombo.options[i-to_remove_counter].text=FromCombo.options[i].text;
			FromCombo.options[i-to_remove_counter].value=FromCombo.options[i].value;
		}
	}

	//now cleanup the last remaining options 
	var numToLeave=FromCombo.options.length-to_remove_counter;
	for (i=FromCombo.options.length-1;i>=numToLeave;i--) 
	{ 
		FromCombo.options[i]=null;
	}
}

function combo_MoveElements2(combo)
{
	var combo = document.getElementById(combo);
	for( i=0 ; i < combo.length ; i++)
	{ 
		if(combo.options[i].selected==true)
		{
			combo.options[i].selected = false;
			combo.options[i] = null;
			i--;
		}
	}
}


function combo_SelectAll(combo)
{
	var combo = document.getElementById(combo);
	for (var i=0;i<combo.options.length;i++)
	{
		combo.options[i].selected=true;
	}
}

function combo_UnSelectAll(combo)
{
	var combo = document.getElementById(combo);
	for (var i=0;i<combo.options.length;i++)
	{
		combo.options[i].selected=false;
	}
}

</script>
<style>
#popup2{
	width:1000px; height:450px !important;  left: 100px; position: fixed; top: 70px !important; z-index: 9999; opacity: 0; display: none;
}
</style>
<div id="popup2" >
    <span class="button b-close"><span>X</span></span>
    <div class="content"></div>
</div>