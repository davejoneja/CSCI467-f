<nav id="nav-bar" class="fixed top-0 left-0 z-50 w-full">
  <div class="flex h-[75px] w-full justify-between bg-gradient-to-bl from-[#9dd8f8] from-5% via-[#55baf2] to-[#9dd8f8]">
    <div class="flex h-full w-[5%] items-center justify-center">
      <a id="home-page" href="./" class="text-3xl text-white" aria-label="Home">
        <i class="fa fa-home" aria-hidden="true"></i>
      </a>
    </div>
    <div class="mr-[2%] flex h-full max-w-md">
      <ul class="flex h-full items-center justify-center gap-10">
        <li>
          <a href="./catalog.php" class="group relative text-xl text-white transition-all duration-300">
            <span class="pb-1 inline-block relative">
              Catalog
              <span class="absolute left-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
              <span class="absolute right-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
            </span>
          </a>
        </li>
        <li>
          <a href="./signinwarehouse.php" class="group relative cursor-pointer text-xl text-white transition-all duration-300">
            <span class="pb-1 inline-block relative">
              <i class="fa fa-lock" aria-hidden="true"></i> Warehouse
              <span class="absolute left-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
              <span class="absolute right-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
            </span>
          </a>
        </li>
        <li>
          <a href="./signin.php" class="group relative cursor-pointer text-xl text-white transition-all duration-300">
            <span class="pb-1 inline-block relative">
              <i class="fa fa-lock" aria-hidden="true"></i> Admin
              <span class="absolute left-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
              <span class="absolute right-1/2 bottom-0 h-0.5 w-0 bg-white transition-all duration-300 ease-in-out transform -translate-x-1/2 group-hover:w-1/2 group-hover:translate-x-0"></span>
            </span>
          </a>
        </li>
        <li class="relative flex flex-col w-10">
          <div class="absolute right-0 w-5 h-5 bg-indigo-900 flex rounded-full">
            <p id="cart-counter" class="text-white self-center mx-auto text-xs">0</p>
          </div>
          <a id="cart" href="./checkout.php" aria-label="Shopping cart" class="text-white text-3xl cursor-pointer transition-all duration-300 hover:text-white">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
