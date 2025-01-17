<header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
        <a href="{{route('home')}}">
            <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="w-32">
        </a>

        <div class="w-full max-w-xl relative flex">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" id="search"
                class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none hidden md:flex"
                placeholder="search">
            <button
                class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition hidden md:flex justify-center items-center">Search</button>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{route('wishlist.show')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="text-xs leading-3">Wishlist</div>
                <div
                    class="absolute right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                    8</div>
            </a>
            <a href="{{route('cart.show')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="text-xs leading-3">Cart</div>
                    <?php
                    if(isset($carts)){
                        $quantity_count=0;
                    foreach ($carts as $id => $details) {
                        $details->quantity;
                        $quantity_count += $details->quantity;
                      }
                      if($quantity_count > 0){
                        print "
                      <div
                    class='absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs'>
                    $quantity_count</div>";
                      }
                    }
                    ?>
            </a>
            <a href="{{route('account.show')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="text-xs leading-3">Account</div>
            </a>
        </div>
    </div>
</header>