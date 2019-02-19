$( document ).ready(function() {
      $('.transactionLinks').live("click", function(){
            $('.messageDiv').hide();
            //$('.donateDiv').show();
      });
      /**************** Donate *******************/
      $('.donateLink').live("click", function(){
            $('#mainContainer').load("../html/donate.html");
            getBanksList("donate");
            $('.bloodBankListDiv').show();
            $('.donateBttn').show();
      });
      // $('.wheretodonanteRadio').live("click", function(){      		//alert($(this).val());
      //       $("input:radio[name='hospitalName']").prop('checked', false);
      //       $("input:radio[name='bankName']").prop('checked', false);
      //       if($(this).val()=="hospitals"){
      //       	$('.bloodBankListDiv').hide();
      //       	$('.hispitalListDiv').show();
      //           getHospitalsList();
      //       }
            
      //       if($(this).val()=="banks"){
      //       	$('.hispitalListDiv').hide();
      //       	$('.bloodBankListDiv').show();
      //           getBanksList("donate");
      //       }
      //       $('.donateBttn').show();
      // });

      function getHospitalsList() {
            var jsonObject={};
			jsonObject['hospitals']="get";
            var JsonData=JSON.stringify(jsonObject);
			var newpath="../php/ajaxGetHospitalList.php";  
				$.ajax({
						 url: newpath,
						 type:'POST',
						 data:{dataJson:JsonData},
						 async:false,
						 success:function(result){							
							  $('#hospitalListTable').html("<tr>"
                                                            +"<th></th>"
                                                            +"<th class='tableHead'>Hospital Name</th>"
                                                            +"<th>Address</th>"
                                                            +"</tr>");
                              var parsedObj = $.parseJSON(result);
                              $.each(parsedObj.hospitals, function( index, value ) {
                                    $('#hospitalListTable').append("<tr>"
                                          +"<td><input value='"+value.id+"' type='radio' name='hospitalName' /></td>"
                                          +"<td>"+value.name+"</td>"
                                          +"<td>"+value.address+"</td>"
                                          +"</tr>");
							  });
						 }//end of success
				});//end of ajax
      } 

      function getBanksList(mode) {
            var jsonObject={};
			jsonObject['banks']="get";
            var JsonData=JSON.stringify(jsonObject);
			var newpath="../php/ajaxGetBankList.php";  
				$.ajax({
						 url: newpath,
						 type:'POST',
						 data:{dataJson:JsonData},
						 async:false,
						 success:function(result){							
							  if (mode=="donate") {
                                    $('#bankListTable').html("<tr>"
                                    +"<th></th>"
                                    +"<th class='tableHead'>Bank Name</th>"
                                    +"<th>Address</th>"
                                    +"</tr>");
                                    var parsedObj = $.parseJSON(result);
                                    $.each(parsedObj.banks, function( index, value ) {
                                          $('#bankListTable').append("<tr>"
                                                +"<td><input value='"+value.id+"' type='radio' class='bankRadioDonateInput' name='bankName' /></td>"
                                                +"<td>"+value.name+"</td>"
                                                +"<td>"+value.address+"</td>"
                                                +"</tr>");
                                    });
                                    $(".bankRadioDonateInput").first().click();
                              }else if(mode=="receive") {                                   
                                    $('#bankListTableRecieve').html("<tr>"
                                    +"<th></th>"
                                    +"<th class='tableHead'>Bank Name</th>"
                                    +"<th>Address</th>"
                                    +"</tr>");
                                    var parsedObj = $.parseJSON(result);
                                    $.each(parsedObj.banks, function( index, value ) {
                                          $('#bankListTableRecieve').append("<tr>"
                                                +"<td><input value='"+value.id+"' type='radio'  name='bankName' /></td>"
                                                +"<td>"+value.name+"</td>"
                                                +"<td>"+value.address+"</td>"
                                                +"</tr>");
                                    });
                                  
                              }else if(mode=="hospital"){
                                $('#bankListTableHospital').html("<tr>"
                                    +"<th></th>"
                                    +"<th class='tableHead'>Bank Name</th>"
                                    +"<th>Address</th>"
                                    +"</tr>");
                                    var parsedObj = $.parseJSON(result);
                                    $.each(parsedObj.banks, function( index, value ) {
                                          $('#bankListTableHospital').append("<tr>"
                                                +"<td><input class='bankListHospital' value='"+value.id+"' type='radio' name='bankName' /></td>"
                                                +"<td>"+value.name+"</td>"
                                                +"<td>"+value.address+"</td>"
                                                +"</tr>");
                                    });

                              }
						 }//end of success
				});//end of ajax
      } 
      function insertDonationDetails() {
            var jsonObject={};
            if($("input:radio[name='hospitalName']:checked").val()){
                  jsonObject['hospitalid']=$("input:radio[name='hospitalName']:checked").val();
            }else{
                  jsonObject['hospitalid']="";
            }
            if($("input:radio[name='bankName']:checked").val()){
                  jsonObject['bankid']=$("input:radio[name='bankName']:checked").val();
            }else{
                  jsonObject['bankid']="";
            }
            //jsonObject['bankid']=$("input:radio[name='bankName']:checked").val();
            jsonObject['personid']=$('#userIdInput').val();
            var JsonData=JSON.stringify(jsonObject);
            var newpath="../php/ajaxInsertDonationDetails.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){                                        
                                             $('.donateDiv').hide();
                                             $('.messageDiv').show();
                                             //location.reload();
                                     }//end of success
                        });//end of ajax
      }     

      $('.donateBttn').live("click", function(){
            insertDonationDetails();
      });

      /***************** Receive ********************/
      $('.receiveLink').live("click", function(){
            $('#mainContainer').load("../html/receive.html");
            getBanksList("receive");
      });
      /**************** Role Switch ******************/
      $('.roleRadioInput').live("click", function(){
            switch($(this).val()) {
                  case "donor":
                        $('#mainContainer').load("../html/donationHistory.html");
                        $('.donorHistoryDiv').show();
                        getDonationHistoryList("donor","na");
                        break;
                  case "recepient":
                        $('#mainContainer').load("../html/receiptHistory.html");
                        getReceiveHistoryList("recepient","na")
                        break;
                  case "bank":
                        $('#mainContainer').load("../html/bank.html");
                        break;
                  case "hospital":
                        $('#mainContainer').load("../html/hospital.html");
                        getBanksList("hospital");
                        break;
                  default:
                         // do nothing
                  break;
            }
      });
      //$('#radio_button').is(':checked')
});//end of doc ready

/**************** Donation History ******************/



function getDonationHistoryList(role,type) {
            var jsonObject={};
                  jsonObject['donors']="get";
                  jsonObject['role']=role;
                  jsonObject['type']=type;
            var JsonData=JSON.stringify(jsonObject);
                  var newpath="../php/ajaxGetDonationHistoryList.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){ 
                                          if(role=="donor" && type=="na"){                                      
                                            $('#donationHistoryTable').html("<tr>"
                                                            +"<th>Bank</th>"                                                                                                                      
                                                            +"<th>Preliminary Test</th>"
                                                            +"<th>Final Test</th>"
                                                            +"<th>Date of Donation</th>"
                                                            +"<th>Quantity</th>"
                                                            +"</tr>");
                                          var parsedObj = $.parseJSON(result);
                                          $.each(parsedObj.donors, function( index, value ) {
                                                $('#donationHistoryTable').append("<tr>"
                                                      +"<td>"+value.name+"</td>"                                                                                    
                                                      +"<td>"+value.preliminary_test+"</td>"
                                                      +"<td>"+value.final_test+"</td>"
                                                      +"<td>"+value.date_of_donation+"</td>"
                                                      +"<td>"+value.quantity+"</td>"
                                                      +"</tr>");
                                            });
                                          }

                                          if(role=="bank" && type=="new"){
                                                $('#bankNewRequestsTable').html("<tr>"
                                                            +"<th>Donor Name</th>"  
                                                            +"<th>Address</th>"                                                                                                                    
                                                            +"<th>Preliminary Test</th>"
                                                            +"<th>Final Test</th>"
                                                            +"<th>Date of Donation</th>"
                                                            +"<th>Quantity</th>"
                                                            +"</tr>");
                                          var parsedObj = $.parseJSON(result);
                                          $.each(parsedObj.donors, function( index, value ) {
                                                $('#bankNewRequestsTable').append("<tr id='NDRrow_"+value.id+"'>"
                                                      +"<td>"+value.fname+"</td>" 
                                                      +"<td>"+value.address+"</td>"                                                                                   
                                                      +"<td class='pTest'>"+value.preliminary_test+"</td>"
                                                      +"<td class='fTest'>"+value.final_test+"</td>"
                                                      +"<td><span class='dateOfDonate'>"+value.date_of_donation+"</span></td>"
                                                      +"<td>"+value.quantity+"</td>"
                                                      +"</tr>");
                                            });
                                          }

                                          if(role=="bank" && type=="history"){
                                                $('#bankHistoryRequestsTable').html("<tr>"
                                                            +"<th>Donor Name</th>"
                                                            +"<th>Address</th>"                                                                                                                       
                                                            +"<th>Preliminary Test</th>"
                                                            +"<th>Final Test</th>"
                                                            +"<th>Date of Donation</th>"
                                                            +"<th>Quantity</th>"
                                                            +"</tr>");
                                          var parsedObj = $.parseJSON(result);
                                          $.each(parsedObj.donors, function( index, value ) {
                                                $('#bankHistoryRequestsTable').append("<tr>"
                                                      +"<td>"+value.fname+"</td>" 
                                                      +"<td>"+value.address+"</td>"                                                                                   
                                                      +"<td>"+value.preliminary_test+"</td>"
                                                      +"<td>"+value.final_test+"</td>"
                                                      +"<td>"+value.date_of_donation+"</td>"
                                                      +"<td>"+value.quantity+"</td>"
                                                      +"</tr>");
                                            });
                                          }
                                     }//end of success
                        });//end of ajax
      }  


      function getBloodStock(role) {
            var jsonObject={};
                  jsonObject['stock']="get";
                  jsonObject['role']=role;
                  if(role=="hospital"){
                      jsonObject['bankId']=$("input:radio[name='bankName']:checked").val();
                  }
            var JsonData=JSON.stringify(jsonObject);
                  var newpath="../php/ajaxGetBloodStock.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){ 
                                          if(role=="bank"){
                                              $('#bankBloodStockTable').html("<tr>"
                                                                +"<th>Blood Group</th>"                                                                                                                      
                                                                +"<th>Stock Qty</th>"
                                                                +"</tr>");
                                              var parsedObj = $.parseJSON(result);
                                              $.each(parsedObj.bloodStock, function( index, value ) {
                                                    $('#bankBloodStockTable').append("<tr>"
                                                          +"<td>"+value.blood_grp+"</td>"                                                                                    
                                                          +"<td>"+value.stock+"</td>"
                                                          +"</tr>");
                                              });
                                        }else if(role=="hospital"){
                                            $('#bloodStockHospitalTable').html("<tr>"
                                                                +"<th>Blood Group</th>"                                                                                                                      
                                                                +"<th>Stock Qty</th>"
                                                                +"</tr>");
                                              var parsedObj = $.parseJSON(result);
                                              $.each(parsedObj.bloodStock, function( index, value ) {
                                                    $('#bloodStockHospitalTable').append("<tr>"
                                                          +"<td>"+value.blood_grp+"</td>"                                                                                    
                                                          +"<td>"+value.stock+"</td>"
                                                          +"</tr>");
                                              });
                                        }
    
                                     }//end of success
                        });//end of ajax
      } 


      function getDonorList(bloodGrpId) {
            var jsonObject={};
                  jsonObject['donors']="get";
                  jsonObject['bloodGrpId']=bloodGrpId;
            var JsonData=JSON.stringify(jsonObject);
                  var newpath="../php/ajaxDonorsList.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){ 
                                          $('#bankDonorsListTable').html("<tr>"
                                                            +"<th>Donor Name</th>"                                                                                                                      
                                                            +"<th>Address</th>"
                                                            +"<th>Email</th>"
                                                            +"<th>Phone</th>"
                                                            +"</tr>");
                                          var parsedObj = $.parseJSON(result);
                                          $.each(parsedObj.donorsList, function( index, value ) {
                                                $('#bankDonorsListTable').append("<tr>"
                                                      +"<td>"+value.fname+"</td>"                                                                                    
                                                      +"<td>"+value.address+"</td>"
                                                      +"<td>"+value.email+"</td>"
                                                      +"<td>"+value.phone+"</td>"
                                                      +"</tr>");
                                            });
    
                                     }//end of success
                        });//end of ajax
      } 


       function insertReceiveDetails() {
            var jsonObject={};
            //alert($('#bloodGroupName').html());
            jsonObject['bloodGroupId']=$('#bloodGroupName').val(); 
            jsonObject['qty']=$('.receiveQty').val();        
            jsonObject['bankid']=$("input:radio[name='bankName']:checked").val();
            
            //jsonObject['bankid']=$("input:radio[name='bankName']:checked").val();
            jsonObject['personid']=$('#userIdInput').val();
            var JsonData=JSON.stringify(jsonObject);
                  var newpath="../php/ajaxInsertReceiveDetails.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){ 
                                         $('.receiveDiv').hide();
                                          $('.messageDiv').show();  
                                          //location.reload();   
                                     }//end of success
                        });//end of ajax
      } 
      $('.recieveBttn').live("click", function(){
            insertReceiveDetails();
      });

      function getReceiveHistoryList(role,type) {
            var jsonObject={};
                  jsonObject['donors']="get";
                  jsonObject['role']=role;
                  jsonObject['type']=type;
            var JsonData=JSON.stringify(jsonObject);
                  var newpath="../php/ajaxGetReceiveHistoryList.php";  
                        $.ajax({
                                     url: newpath,
                                     type:'POST',
                                     data:{dataJson:JsonData},
                                     async:false,
                                     success:function(result){ 
                                          if(role=="hospital" && type=="na"){                                      
                                            
                                          }

                                          if(role=="recepient" && type=="na"){ 
                                              $('#receiveHistoryTable').html("<tr>"
                                                                +"<th>Bank Name</th>"                                                                                                                      
                                                                +"<th>Blood Group</th>"
                                                                +"<th>Quantity</th>"
                                                                +"<th>Date Of Receive</th>"
                                                                +"<th>Status</th>"
                                                                +"</tr>");
                                              var parsedObj = $.parseJSON(result);
                                              $.each(parsedObj.receivers, function( index, value ) {
                                                    $('#receiveHistoryTable').append("<tr>"
                                                          +"<td>"+value.name+"</td>"                                                                                    
                                                          +"<td>"+value.blood_grp+"</td>"
                                                          +"<td>"+value.quantity+"</td>"
                                                          +"<td>"+value.date_of_receive+"</td>"
                                                          +"<td>"+value.status+"</td>"
                                                          +"</tr>");
                                                });                                      
                                            
                                          }

                                          if(role=="bank" && type=="new"){
                                               $('#bankNewReceiveTable').html("<tr>"
                                                            +"<th>Receiver Name</th>"                                                                                                                      
                                                            +"<th>Blood Group</th>"
                                                            +"<th>Quantity</th>"
                                                            +"<th>Date</th>"
                                                            +"<th>Status</th>"
                                                            +"</tr>");
                                          var parsedObj = $.parseJSON(result);
                                          $.each(parsedObj.receivers, function( index, value ) {
                                                $('#bankNewReceiveTable').append("<tr id='NRRrow_"+value.id+"'>"
                                                      +"<td>"+value.fname+"</td>"                                                                                    
                                                      +"<td>"+value.blood_grp+"</td>"
                                                      +"<td>"+value.quantity+"</td>"
                                                      +"<td>"+value.date_of_receive+"</td>"
                                                      +"<td><span class='dateOfReceive'>"+value.status+"</span></td>"
                                                      +"</tr>");
                                            }); 
                                          }

                                          if(role=="bank" && type=="history"){
                                                $('#bankHistoryReceiveTable').html("<tr>"
                                                            +"<th>Receiver Name</th>"                                                                                                                      
                                                            +"<th>Blood Group</th>"
                                                            +"<th>Quantity</th>"
                                                            +"<th>Date</th>"
                                                            +"<th>Status</th>"
                                                            +"</tr>");
                                                var parsedObj = $.parseJSON(result);
                                                $.each(parsedObj.receivers, function( index, value ) {
                                                      $('#bankHistoryReceiveTable').append("<tr>"
                                                            +"<td>"+value.fname+"</td>"                                                                                    
                                                            +"<td>"+value.blood_grp+"</td>"
                                                            +"<td>"+value.quantity+"</td>"
                                                            +"<td>"+value.date_of_receive+"</td>"
                                                            +"<td>"+value.status+"</td>"
                                                            +"</tr>");
                                                  }); 
                                          }
                                     }//end of success
                        });//end of ajax          


      }  

/**************************************** home ************************************/
$("#slideshow > div:gt(0)").hide();

setInterval(function() {
  $('#slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
}, 5000);
      