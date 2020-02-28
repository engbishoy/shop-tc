@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')
        
              
          @include('layouts.message')
          <br>
                <section class="content">
        <div class="container">
	    
          <div class="panel panel-default">
            <div class="panel-heading">Edit item</div>
            <div class="panel-body">
          
                     
          <form class="form-horizontal" action="/updateitem/{{$value->id}}" method="POST"  enctype="multipart/form-data">
              {{ csrf_field() }}
              @method('PUT')
                     <div class="row">
                       
                     <div class="col-md-6 col-xs-12">
                     
                     
                      <div class="form-group form-group-lg">
                         <label class="col-lg-2 col-sm-4 col-xs-12 control-label"> Name</label>  
                            <div class="col-lg-8 col-sm-8 col-xs-12 ">
                    <input type="text" name="name" class="form-control"  value="{{$value->name}}"  required="required" placeholder="Name the Item">
                  </div>
             
                </div>
                        
                      
                      
                      <?php
                      
                      
                      
                      $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
              
              
              
              
                      $namecountry=implode(",",$countries);
                      
                      
                      
                      
                      ?>
                       
                          <div class="form-group form-group-lg">
                         <label class="col-lg-2 col-sm-4 col-xs-12 control-label">Made</label>  
                            <div class="col-lg-8 col-sm-8 col-xs-12 ">
                            <select class="form-control" name="country">
                              <option value="{{$value->country}}" >{{$value->country}}</option>
                              <?php
                              $countcountry=count($countries);
                      for($i=0;$i<$countcountry;$i++){
                                  echo '<option value="'.$countries[$i].'">';
                        echo $countries[$i];
                        echo '</option>';
                      }
                  
                              ?>
                              
                              
                            </select>
                                               </div>
             
                      </div>
                       
                         <div class="form-group form-group-lg">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"> Statue</label>  
                            <div class="col-lg-8 col-sm-8 col-xs-12 ">
                            <select class="form-control" name="status">
                              <option value="1" @if($value->status_product==1) selected @endif>New</option>
                              
                              <option value="2" @if($value->status_product==2) selected @endif>Used</option>
                             
                             
                            </select>
                      
                             </div>
             
                      </div>
                      
                            
                      <div class="form-group form-group-lg">
                          <label class="col-lg-2 col-sm-4 col-xs-12 control-label"> Number</label>  
                              <div class="col-lg-8 col-sm-8 col-xs-12 ">
                        <input type="text" name="number" class="form-control"  value="{{$value->number_product}}"  required="required" placeholder="Price the Item">
                               </div>
               
                        </div>
          
                      <?php
                      $location=array('Cairo',
                      'Alexandria',
                      'Giza',
                      'Al Kalyoubia',
                      '6th October',
                      'Helwan',
                      'Matrouh',
                      'Al Wadi Al Gadeed',
                      'Al Beheira',
                      'Al Gharbeya',
                      'Al Sharkeya',
                      'Kafr El Sheikh',
                      'Al Menofeya',
                      'Al Daqahleya',
                      'Damietta',
                      'Port Said',
                      'Ismailia',
                      'Suez',
                      'Al Bahr El Ahmar (Red sea)',
                      'North Sinai',
                     ' South Sinai',
                     ' Al Fayoum',
                     ' Bany Swaif',
                      'Al Menia',
                      'Assyout',
                     ' Sohag',
                      'Luxor',
                      'Qena',
                      'Aswan'
                      );
          
                      ?>
                     
          
                      <div class="form-group form-group-lg">
                          <label class="col-lg-2 col-sm-4 col-xs-12 control-label"> Location</label>  
                              <div class="col-lg-8 col-sm-8 col-xs-12 ">
                              <select class="form-control" name="location">
                               @foreach($location as $loc)
                                 <option value='{{$loc}}' @if($value->location ==$loc) selected @endif>{{$loc}}</option>
                                
                                  @endforeach
                                
                                
                              </select>
                        
                               </div>
               
                        </div>
                      
          
                      <div class="form-group form-group-lg">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"> Category</label>  
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                            <select class="form-control" name="category">
                                @foreach ($cat as $cats)
                        <option value='{{$cats->id}}' @if($value->cat_id==$cats->id) selected @endif>{{$cats->name}}</option>
                                @endforeach
                            </select>
                             </div>
             
                      </div>
                   
                </div>
                  
                    
                <div class="col-md-6 col-xs-12">
                          
                  <div class="right-add">
                             <div class="form-group form-group-lg">
                       <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label"> Select Photos</label>  
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                            <img src='{{asset('imges/imgsite/33.png')}}'>
                            <input class="add-img" type="file" multiple name="imgesitem[]">
                            <input type="hidden" name="myphoto"  value="{{$value->photo}}">
                             </div>
             
                      </div>
          
          
                      <div class="form-group form-group-lg ">
                       <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label"> Description</label>  
                            <div class="col-lg-8 col-sm-8 col-xs-12   ">
                      <textarea type="text" name="describe" class="form-control" style="margin-top:10px;
              height: 210px;" required placeholder="Describe the Item" >{{$value->description}}</textarea>
                             </div>
             
                      </div>
                      
                      
                      
                      
                                                    
                      </div>					
                          
                          
                                   
                   </div>				
                   </div>
                      
             
             <div class="form-group">
          
              <div class="col-lg-offset-1  col-sm-offset-2 col-sm-10">
            <input class="btn btn-primary" style="margin-top:20px" type="submit" value="Edit item" name="submit">
              </div>
                </div>				
                </form>
              
                  </div>
          </div>
                    

    </div>


                </section>
        
                @include('normal users/layouts/footer');


          @endsection
          