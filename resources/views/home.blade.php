@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
               <ul>
                <li>
                  {{-- <a class="facebook customer share" href="https://www.facebook.com/sharer.php?u=http://165.22.54.222/en/products/DLS6060-002GR" title="Facebook share" target="_blank">Facebook</a> --}}

                  <a  class="facebook customer share" 
                  href="https://www.facebook.com/sharer.php?u=http://165.22.54.222/en/products/DLS6060-002GR">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><circle cx="15" cy="15" r="15" fill="#F3F3F3"></circle><path d="M17.5395 9.65667H19V7.11267C18.748 7.078 17.8814 7 16.8722 7C12.2512 7 13.5085 12.2333 13.3245 13H11V15.844H13.3238V23H16.1729V15.8447H18.4027L18.7567 13.0007H16.1722C16.2976 11.118 15.6649 9.65667 17.5395 9.65667Z" fill="#6E6E6E"></path></svg></a>

                </li>

                

                  <a  class="linkedin customer share" 
                  href="https://www.linkedin.com/sharing/share-offsite/?url=http://165.22.54.222/en/products/DLS6060-002GR">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><circle cx="15" cy="15"r="15" fill="#F3F3F3"></circle><path d="M21.9962 22V21.9995H21.9997V16.865C21.9997 14.3531 21.459 12.4182 18.5225 12.4182C17.1108 12.4182 16.1635 13.1929 15.7767 13.9273H15.7359V12.6527H12.9517V21.9995H15.8508V17.3713C15.8508 16.1527 16.0818 14.9744 17.5909 14.9744C19.0778 14.9744 19.1 16.365 19.1 17.4495V22H21.9962Z" fill="#6E6E6E"></path><path d="M8.23096 12.6531H11.1336V21.9998H8.23096V12.6531Z" fill="#6E6E6E"></path><path d="M9.68117 8C8.75308 8 8 8.75308 8 9.68117C8 10.6093 8.75308 11.3781 9.68117 11.3781C10.6092 11.3781 11.3623 10.6093 11.3623 9.68117C11.3617 8.75308 10.6087 8 9.68117 8V8Z" fill="#6E6E6E"></path></svg></a>
                </li>
              </ul>

                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')


{{-- <script type="text/javascript">
  ;(function($){
  
  /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    
    // Prevent default anchor event
    e.preventDefault();
    
    // Set values for window
    intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (blnResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
        strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
        objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
  }
  
  /* ================================================== */
  
  $(document).ready(function ($) {
    $('.customer.share').on("click", function(e) {
      $(this).customerPopup(e);
    });
  });
    
}(jQuery));


</script> --}}
<script async src="https://static.addtoany.com/menu/page.js"></script>
@endsection