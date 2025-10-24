<form
  class="flex flex-col md:flex-row gap-2 mx-5 md:mx-auto max-w-4xl"
  method="GET"
  action="{{ route('jobs.search') }}"
>
  <input
    type="text"
    name="keywords"
    placeholder="Keywords"
    class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white placeholder:text-gray-400"
    value="{{ request('keywords') }}"
  />
  <input
    type="text"
    name="location"
    placeholder="Location"
    class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white placeholder:text-gray-400"
    value="{{ request('location') }}"
  />
  <button
    type="submit"
    class="px-6 py-3 bg-pink-500 hover:bg-pink-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2"
  >
    <i class="fa fa-search mr-2"></i> Search
  </button>
</form>