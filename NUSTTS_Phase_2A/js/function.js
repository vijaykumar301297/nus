function reporttype(argument) {
	if(argument == 'single'){
		$('.single').show();
		$('.multi').hide();
		$('.international').hide();
		$('.tradehistroy').hide();
		$('.rpoe').addClass('col-md-12');
		$('.rpoe').removeClass('col-md-6');
		$('.multcon').hide();
		$('.reprttype').hide();
	}
	if(argument == 'multi'){
		$('.single').hide();
		$('.multi').show();
		$('.international').hide();
		$('.tradehistroy').hide();
		$('.multcon').show();
		$('.reprttype').hide();
		$('.rpoe').removeClass('col-md-12');
		$('.rpoe').addClass('col-md-6');

	}
	if(argument == 'international'){
		$('.single').hide();
		$('.multi').hide();
		$('.international').show();
		$('.tradehistroy').hide();
		$('.reprttype').show();
		$('.multcon').hide();
		$('.rpoe').removeClass('col-md-12');
		$('.rpoe').addClass('col-md-6');
	}
	if(argument == 'tradehistry'){
		$('.single').hide();
		$('.multi').hide();
		$('.international').hide();
		$('.tradehistroy').show();
		$('.multcon').hide();
		$('.reprttype').hide();
		$('.rpoe').addClass('col-md-12');
		$('.rpoe').removeClass('col-md-6');
	}
}
function addclient(){
	var rowVal = parseInt($('.rowclient').val())+1;
	var printdata ='';
	printdata ='<div class="row">';
	printdata +='<div class="col-md-5">';
    printdata +='<select name="client'+rowVal+'" onchange="getallsupplycontract(this.value)" class="form-control client'+rowVal+'">';
    printdata +='</select>';
    printdata +='</div>';
    printdata +='<div class="col-md-5">';
    printdata +='<div class="multse">';
    printdata +='<select id="framework'+rowVal+'" name="framework[]" multiple class="form-control">';
    printdata +='</div></div></div>';
    $('.addedclient').append(printdata);
    $('.client'+rowVal+'').html($('.listclients').html());
    // $('.listclients').find('option').clone().appendTo('.client'+rowVal+'');
    rowVal = rowVal;
    $('.rowclient').val(rowVal);
    
}
function addcountries(){
	var rowVal = parseInt($('.rowcountries').val())+1;
	var printdata ='';
	printdata ='<div class="row">';
	printdata +='<div class="col-md-5">';
    printdata +='<select name="country'+rowVal+'" onchange="getsupplycontractcounty(this.value)" class="form-control countryval'+rowVal+'">';
    printdata +='</select>';
    printdata +='</div>';
    printdata +='<div class="col-md-5">';
    printdata +='<div class="multse">';
    printdata +='<select id="countyr'+rowVal+'" name="framework[]" multiple class="form-control">';
    printdata +='</div></div></div>';
    $('.addedcountry').append(printdata);
    $('.countryval'+rowVal+'').html($('.listcountries').html());
    // $('.listclients').find('option').clone().appendTo('.client'+rowVal+'');
    rowVal = rowVal;
    $('.rowcountries').val(rowVal);
    
}
function getclientfromcountry(val){
	var getCommodity = $('.commodityreport:checked').val();
	var countryname = val;
	$.ajax({
            url: 'ajax/getclientcountry.php',
            type: "POST",
            data: {
            	'commodity':getCommodity,
                'countryname': countryname

            },
            success: function(result) {
            	console.log(result);
            	$('.listclients').html(result);
            }
        })
}
function getallsupplycontract(value){

	var getCommodity = $('.commodityreport:checked').val();
	var county = $('.countries').val();
	var rocnt = parseInt($('.rowclient').val());
	
	$.ajax({
            url: 'ajax/getallclients.php',
            type: "POST",
            data: {
            	'commodity':getCommodity,
                'countryname': county,
                'client':value

            },
            success: function(result) {
            	console.log(rocnt);
            	$('#framework'+rocnt).html(result);
            	$('#framework'+rocnt).multiselect({
				  nonSelectedText: 'Select Contract',
				  enableFiltering: true,
				  enableCaseInsensitiveFiltering: true,
				  buttonWidth:'300px'
				 });
            }
    })

}
function getsupplycontractcounty(val){
	var getCommodity = $('.comdityinter:checked').val();
	var parent = $('.paret').val();
	var rocnt = parseInt($('.rowcountries').val());
	
	$.ajax({
            url: 'ajax/getallcountryclients.php',
            type: "POST",
            data: {
            	'commodity':getCommodity,
                'parent': parent,
                'country':val

            },
            success: function(result) {
            	console.log(result);
            	$('#countyr'+rocnt).html(result);
            	$('#countyr'+rocnt).multiselect({
				  nonSelectedText: 'Select Country',
				  enableFiltering: true,
				  enableCaseInsensitiveFiltering: true,
				  buttonWidth:'300px'
				 });
            }
    })
}

function contractTermchange(contract){
          $.ajax({
            url: 'ajax/getContractTerm.php',
            type: "POST",
            data: {
                'contract': contract
            },
            success: function(result) {
               var obj = JSON.parse(result);
               $('.indexcnt').html(obj.indexData);
               $('.fixcnt').html(obj.fixedData);
            }
        })
}
 function clientChange(val){
        
        console.log(val);
        $.ajax({
            url: 'ajax/getreport.php',
            type: "POST",
            data: {
                country_data: val
            },
            success: function(result) {
              

                $('#contract').html(result);

                // console.log(result);
            }
        })
    }

 function parentdetails(parentId){
  $.ajax({
      type:'POST',
      url: 'js/callbacks/parentdetails.php',
      data:{
        'parentId':parentId
      
      },
      success: function(data){
        $('.clientcom').html(data);
      }
    });
}

function parentdetails_GenerateReport(parentId) {
    $.ajax({
        type:'POST',
        url: 'js/callbacks/parentdetailsGenReport.php',
        data:{
          'parentId':parentId
        
        },
        success: function(data){
          $('.clientcom').html(data);
        }
      });
}

function clientChange(val){
        
        console.log(val);
        $.ajax({
            url: 'ajax/getfixedreport.php',
            type: "POST",
            data: {
                countrydata: val
            },
            success: function(result) {
              

                $('#fixedcontract').html(result);

                // console.log(result);
            }
        })
    }
    function getcontract(clinet){
        $.ajax({
            url: 'ajax/gettradecontract.php',
            type: "POST",
            data: {
                'client': clinet
            },
            success: function(result) {
              console.log(result);
               $('.tradecontract').html(result);
            }
        })
    }