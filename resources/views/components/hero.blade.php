@props(['title' => 'Find Your Dream Job'])

<section
  class="relative bg-cover bg-center bg-no-repeat h-96 flex items-center"
  style="background-image: url('{{ asset('images/hero.jpg') }}')"
>
  <!-- Dark overlay -->
  <div class="absolute inset-0 bg-black/80 z-0"></div>
  
  <div class="container mx-auto text-center relative z-10">
    <h2 class="text-4xl text-white font-bold mb-4">{{ $title }}</h2>
    <form class="flex flex-col md:flex-row gap-2 mx-5 md:mx-auto md:justify-center">
      <input
        type="text"
        name="keywords"
        placeholder="Keywords"
        class="w-full md:w-72 px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900"
      />
      <input
        type="text"
        name="location"
        placeholder="Location"
        class="w-full md:w-72 px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900"
      />
      <button
        class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
      >
        <i class="fa fa-search mr-1"></i> Search
      </button>
    </form>
  </div>
</section>