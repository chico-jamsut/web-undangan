<!-- Navbar -->
<style>
  nav {
    backdrop-filter: blur(1px) saturate(150%);
    -webkit-backdrop-filter: blur(10px) saturate(150%);
  }
</style>
 <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between bg-black/60 backdrop-blur-xl text-white px-8 py-4 shadow-lg transition-all duration-300">

<div class="flex items-center gap-3">
    <img src="./public/logo.png" alt="Logo GSX" class="h-15 w-auto">
    <div class="text-xl font-bold logo">GSX Brotherhood Riders</div>
  </div>
  <ul class="flex gap-8 relative text-xl">
    <!-- <li><a href="#" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Home</a></li> -->
    <li><a href="#profile" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Profile</a></li>
    <li><a href="#visi" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Visi dan Misi</a></li>
    <li><a href="#galeri" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Galeri</a></li>
    <li><a href="#produk" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Produk Kami</a></li>
    <li><a href="#kontak" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Kontak Kami</a></li>
    
    <!-- Dropdown menu -->
    <li class="relative group">
      <a href="#" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Lainnya</a>
      <ul class="absolute hidden group-hover:flex flex-col bg-white text-black mt-2 py-2 w-40 shadow-lg rounded-md z-10">
        <li><a href="./src/artikel.php" class="block px-4 py-2 hover:bg-red-400">Artikel</a></li>
        <li><a href="./src/event.php" class="block px-4 py-2 hover:bg-red-400">Event</a></li>
        <li><a href="./src/klien.php" class="block px-4 py-2 hover:bg-red-400">Klien</a></li>
      </ul>
    </li>

    <li><a href="#tentang" class="hover:text-red-700 hover:border-b-2 hover:border-red-500 pb-1 transition-all duration-100 ease-in-out">Tentang Kami</a></li>
  </ul>
</nav>