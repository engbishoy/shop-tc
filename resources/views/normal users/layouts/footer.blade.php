    <footer class="site-footer" style="margin-bottom: -24px;">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <h6>About</h6>
                  <p class="text-justify">
                    My name is beshoy wafik. I have been graduated <br>
                    from the faculty of computer science at the higher technology institute<br>
                    i got a great experience in web development <br>
                    i created this site to provide a service that allow the selling <br>
                   and trading between the sellers and costumers become more easier.
                  </p>
                
                
                </div>
      
                <div class="col-xs-6 col-md-3">
                  <h6>Categories</h6>
                  <ul class="footer-links">
                    @foreach($cat as $cats)
                    <li><a href="/category/{{$cats->id}}">{{$cats->name}}</a></li>
                    @endforeach
                  </ul>
                </div>
      
                <div class="col-xs-6 col-md-3">
                  <h6>Quick Links</h6>
                  <ul class="footer-links">
                      <li><a href="/">Home</a></li>
                      <li><a href="/aboutus">About Us</a></li>
                    <li><a href="/category/all">Categories</a></li>
                    <li><a href="/contactus">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <hr>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <p class="copyright-text">Design and programming by Bishoy wafik</p>
                </div>
      
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>   
                  </ul>
                </div>
              </div>
            </div>
      </footer>