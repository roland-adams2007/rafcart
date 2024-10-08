<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Ecommerce Tailwind</title>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <script src="{{asset('assets/script/tailwind.js')}}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
      <!-- header -->
      @include('header')
      <!-- ./header -->
  
      <!-- navbar -->
      @include('nav')
      <!-- ./navbar -->
    

    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Cart</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- wrapper -->
    <div class="container  flex w-full justify-center items-center gap-6 pt-4 pb-16">


        <!-- cart -->
            @if ($carts)
            <div class="flex flex-col  w-full  min-h-32 ">
                <div class="w-full h-full flex flex-col gap-y-2">
                   @foreach ($carts as $id => $details)
                   <div class="flex items-center justify-between border gap-6  p-4 border-gray-200 rounded overflow-x-auto">
                       <div class="w-28 hidden md:block">
                           <img src="{{asset($details->image)}}" alt="product 6" class="w-full">
                       </div>
                       <div class="w-1/3">
                           <h2 class="text-gray-800 text-sm md:text-xl font-medium uppercase">{{$details->product_name}}</h2>
                           <p class="text-gray-500 text-sm">Quantity: <span class="text-green-600">{{$details->quantity}}</span></p>
                       </div>
                       <div class="text-primary text-lg font-semibold">${{$details->price}}</div>
                       
                       <div class="flex items-center gap-x-1">
                           <button type="button" class=" text-white bg-green-500 p-2">+</button>
                           <input type="number" min='1' value="{{$details->quantity}}" name="quantity" id="quantity" class="w-8 sm:w-16 md:w-20 focus:outline-none">
                           <button type="button" class=" text-white bg-red-500 p-2">-</button>
                       </div>
   
                       <div class="text-gray-600 cursor-pointer hover:text-primary">
                           <i class="fa-solid fa-trash"></i>
                       </div>
                   </div>
                   @endforeach
                </div>
                <div class="w-full flex justify-end max-h-sm mt-8">
                   <div class="w-80 bg-white border border-gray-300 rounded-sm  h-full flex flex-col p-2 gap-y-2 rounded-sm ">
                     <div class="h-10 flex items-center justify-center border-b"><h1 class="font-bold text-md md:text-lg">Proceed to Checkout</h1></div>
                     <div class="w-full flex flex-col gap-y-2 h-full">
                       <div class="h-full">
                           <div class="h-full w-full flex flex-col gap-x-1">
                              @foreach ($carts as $id => $details)
                              <div class="w-full  flex justify-between border border-gray-200 rounded p-3">
                               <p>{{$details->product_name}} x {{$details->quantity}}</p>
                               <p>${{$details->price * $details->quantity}}</p>
                             </div>
                              @endforeach
                           </div>
                       </div>
                       <div class="w-full h-12 flex justify-between items-center border-t ">
                           <div><p class="font-medium text-sm md:text-lg uppercase">Total: <span class="font-medium">
                            
                            <?php
                                if($carts){
                                    $total=0;
                                    foreach ($carts as $key => $details) {
                                        $total += ($details->quantity * $details->price);
                                    }
                                    print "$$total";
                                }
                                ?>    
                        </span></p></div>
                           <div>
                               <form action="{{route('checkout.show')}}" method="get">
                                @csrf
                                   {{-- <input type="hidden" name=""> --}}
                                   <button type="submit" class="bg-primary border border-primary text-white px-8 rounded-md hover:bg-transparent hover:text-primary transition p-2">Proceed</button>
                               </form>
                           </div>
                       </div>
                     </div>
                   </div>
                </div>
               
   
           
           </div>
            @else
                <div class="w-full h-full flex justify-center items-center">
                   <div>No product available in the cart</div>
                </div>
            @endif
        <!-- ./cart -->

    </div>
    <!-- ./wrapper -->

    <!-- footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container grid grid-cols-3">
            <div class="col-span-1 space-y-8 mr-2">
                <img src="../assets/images/logo.svg" alt="logo" class="w-30">
                <div class="mr-2">
                    <p class="text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, hic?
                    </p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-facebook-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-instagram-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-twitter-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <i class="fa-brands fa-github-square"></i>
                    </a>
                </div>
            </div>

            <div class="col-span-2 grid grid-cols-2 gap-8">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Solutions</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Support</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Solutions</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Support</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ./footer -->

    <!-- copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container flex items-center justify-between">
            <p class="text-white">&copy; TailCommerce - All Right Reserved</p>
            <div>
                <img src="../assets/images/methods.png" alt="methods" class="h-5">
            </div>
        </div>
    </div>
    <!-- ./copyright -->

</body>

</html>