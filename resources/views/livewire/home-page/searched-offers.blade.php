<div class="dark:bg-gray-900">
  @livewire('applying-process')
  @unless (!$showingFilter)
  <div wire:loading.class='opacity-50 duration-200' wire:click.outside="$set('showingFilter', false)"
    class="rounded-lg absolute w-[378px] top-24 right-48 bg-gray-100 dark:bg-gray-800 z-50 p-5 shadow-xl">
    @livewire('home-page.filter-offers')
  </div>
  @endunless
  <div class="flex px-12 py-4">
    <div class="job-name">
      <h3 class="text-lg font-bold text-[var(--color-primary)]">
        "{{ Session::get('last_search_title', ''). " - " . Session::get('last_search_location', '') }}"</h3>
      <p class="text-base font-light text-gray-400">Results found {{isset($offers) ? $offers->count() : 0 }}</p>
    </div>
    <div class="flex justify-end flex-1">
      <button wire:click="$toggle('showingFilter')"
        class="flex gap-4 px-6 h-10 font-bold bg-gray-200 dark:bg-gray-900 text-gray-500 dark:text-gray-400 rounded-full border-[1px] border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 duration-200 shadow-sm"
        id="btn-filters">
        <span class="my-auto">
          <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 2.8H21V4.2H0V2.8Z" fill="#888" />
            <path d="M0 10.5H21V11.9H0V10.5Z" fill="#888" />
            <path
              d="M9.41379 3.15C9.41379 4.8897 7.95486 6.3 6.15517 6.3C4.35549 6.3 2.89655 4.8897 2.89655 3.15C2.89655 1.4103 4.35549 0 6.15517 0C7.95486 0 9.41379 1.4103 9.41379 3.15Z"
              fill="#888" />
            <path
              d="M17.3793 10.85C17.3793 12.5897 15.9204 14 14.1207 14C12.321 14 10.8621 12.5897 10.8621 10.85C10.8621 9.1103 12.321 7.7 14.1207 7.7C15.9204 7.7 17.3793 9.1103 17.3793 10.85Z"
              fill="#888" />
            <path
              d="M6.15517 5.3C5.91447 5.3 5.6844 5.26482 5.46948 5.2H6.84086C6.62594 5.26482 6.39588 5.3 6.15517 5.3ZM7.91221 1.8H4.39814C4.80687 1.31653 5.43317 1 6.15517 1C6.87718 1 7.50347 1.31653 7.91221 1.8ZM14.1207 13C13.88 13 13.6499 12.9648 13.435 12.9H14.8064C14.5915 12.9648 14.3614 13 14.1207 13ZM15.8777 9.5H12.3637C12.7724 9.01653 13.3987 8.7 14.1207 8.7C14.8427 8.7 15.469 9.01653 15.8777 9.5Z"
              stroke="#888" stroke-width="2" />
          </svg>
        </span>
        <span class="my-auto">
          Filters
        </span>
      </button>
    </div>
  </div>
  @if(!empty($offers) && isset($offers[self::$selectedPostId]))
  <div>
    @unless(empty($offers))
    <div class="flex align-top m-10 mb-20 gap-6">
      <div id="offers-list-container"
        class="blur-dev list-content-container flex-1 md:max-h-[585px] overflow-hidden md:overflow-y-scroll pr-[3%]">
        <ul class="list-content list-none">

          @foreach($offers as $key => $offer)
          <li id="post-{{ self::$postId++ }}" wire:click="showOfferDetails({{ $key+1 }},{{$offer->id}})"
            class="{{ $key == self::$selectedPostId ? "checked" : "unchecked" }} cursor-pointer hover:translate-x-1 duration-200 py-[4%] px-[5%] border-b-[0.5px] border-gray-300 dark:border-gray-600 dark:text-gray-300">
            <div class="ic-name-rating-like flex justify-start items-center gap-[3%]">
              <img class="rounded-full w-10 h-10 shadow-xl"
                src="@foreach ($users as $user) {{ $offer->user_id == $user->id ? 'storage/'.$user->profile_photo_path : null}} @endforeach"
                alt="{{ "img_" . $employers[$offer->id-1]->companyName }}">
              <h3 class="font-bold text-xl">
                @foreach ($employers as $employer)
                {{ $employer->user_id == $offer->user_id ? $employer->companyName : null }}
                @endforeach
              </h3>
              <div class="flex justify-end flex-1">
                <span wire:loading.class='scale-90 opacity-50 duration-200' wire:target='addFav({{ $offer->id }})'
                  @if($offer->id-1 == self::$selectedPostId) wire:click='addFav({{ $offer->id }})' @else
                  wire:click.stop='addFav({{ $offer->id }})' @endif class="ic-like rounded-full hover:bg-gray-100
                  dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                  <img
                    src="{{ $this->likedPost($offer->id-1) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png'}} "
                    alt="ic-heart" width="30" height="30">
                </span>
              </div>
            </div>
            <div class="flex">
              <div class="flex flex-col flex-1">
                <h2 class="mt-[5%] text-xl dark:text-gray-100">{{ $offer->title }}</h2>
                <span
                  class="font-light text-gray-400 mt-[3%]">{{ App\Models\Country::getCountry($offer->country_id)->name . ", ". App\Models\City::getCity($offer->city_id)->name }}</span>
                <span class="font-light text-gray-400">{{ "[$offer->flexibility" . "]"}}</span>
                <span class="font-medium text-[var(--color-primary)] mt-[2%]">{{'$'. $offer->salary }}</span>
              </div>
              <div class="flex flex-1 justify-end items-end">
                <span class="font-thin text-gray-400 text-[14px]">
                  {{ App\Livewire\HomePage\JobseekerOffers::getPostPublishDay($offer) }}
                </span>
              </div>
            </div>
          </li>
          @endforeach

        </ul>
      </div>
      <div
        class="blur-dev content-details flex-1 max-w-[50%] max-h-[585px] border-l border-gray-400 overflow-y-scroll hidden md:block"
        id="offer-description">
        <div class="flex items-center ml-[5%]">
          <img wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
            class="rounded-full w-10 h-10 shadow-xl"
            src="@foreach ($users as $user) {{ $offers[self::$selectedPostId]->user_id == $user->id ? 'storage/'.$user->profile_photo_path : null}} @endforeach">
          <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
            class="ml-[3%] text-xl dark:text-gray-300">

            @foreach ($employers as $key=>$employer)
            {{ $offers[self::$selectedPostId]->user_id == $employer->user_id ? $employer->companyName : null }}
            @endforeach
          </h3>
          <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
            <span class="rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
              <img src="images/ic-report.png" alt="ic-heart" width="30" height="30">
            </span>
            <span wire:loading.class='scale-90 opacity-50 duration-200'
              wire:target='addFav({{ self::$selectedPostId }})' wire:click='addFav({{ self::$selectedPostId }})'
              class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
              <img
                src="{{ $this->likedPost(self::$selectedPostId+1) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                alt="ic-heart" width="30" height="30">
            </span>
            <button wire:click="showModal()"
              class="bg-[var(--color-primary)] border-[1px] px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Apply</button>
          </div>
        </div>
        <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
          class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
          {{ $offers[self::$selectedPostId]->title }}
        </h3>
        <div class="flex flex-col">
          <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
            class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($offers[self::$selectedPostId]->country_id)->name . ", ". App\Models\City::getCity($offers[self::$selectedPostId]->city_id)->name }}</span>
          <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
            class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ "[". $offers[self::$selectedPostId]->flexibility . "]"}}</span>
        </div>
        <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
        <div wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
          class="content-description px-[4%] dark:text-gray-300">
          {!! $offers[self::$selectedPostId]->description !!}
        </div>
      </div>
    </div>
    @endunless
  </div>
  @else
  <div class="flex flex-wrap-reverse justify-center md:gap-40 py-10 md:py-0 dark:*:text-gray-200">
    <div class="max-w-52 sm:max-w-full">
      <h1>We couldn’t find any jobs matching your search</h1>
      <h2 class="mt-4">Search tips:</h2>
      <ul>
        <li>Try using different keywords</li>
        <li>Check your spelling</li>
        <li>Broaden your search by using fewer or more general words</li>
      </ul>
    </div>
    <div>
      <svg width="294" height="240" viewBox="0 0 294 240" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M292.82 203H13.75C13.6174 203 13.4902 202.947 13.3964 202.854C13.3027 202.76 13.25 202.633 13.25 202.5C13.25 202.367 13.3027 202.24 13.3964 202.146C13.4902 202.053 13.6174 202 13.75 202H292.82C292.953 202 293.08 202.053 293.174 202.146C293.267 202.24 293.32 202.367 293.32 202.5C293.32 202.633 293.267 202.76 293.174 202.854C293.08 202.947 292.953 203 292.82 203Z"
          fill="#D7D7D7" />
        <path
          d="M72.9699 110.72C112.624 110.72 144.77 86.1273 144.77 55.7904C144.77 25.4534 112.624 0.860352 72.9699 0.860352C33.3159 0.860352 1.16992 25.4534 1.16992 55.7904C1.16992 86.1273 33.3159 110.72 72.9699 110.72Z"
          fill="white" />
        <path
          d="M73 111.22C33.14 111.22 0.709961 86.3601 0.709961 55.7901C0.709961 25.2201 33.11 0.370117 73 0.370117C112.89 0.370117 145.3 25.2301 145.3 55.7901C145.3 86.3501 112.84 111.22 73 111.22ZM73 1.37012C33.69 1.37012 1.70996 25.7801 1.70996 55.7901C1.70996 85.8001 33.71 110.22 73 110.22C112.29 110.22 144.3 85.8101 144.3 55.7901C144.3 25.7701 112.29 1.37012 73 1.37012Z"
          fill="#D7D7D7" />
        <path
          d="M152.76 32.16C152.423 32.1701 152.087 32.2171 151.76 32.3C148.01 33.3 146.96 38.44 151.17 39.82C151.751 39.9777 152.36 40.0107 152.955 39.9172C153.55 39.8236 154.118 39.6054 154.623 39.2769C155.128 38.9484 155.558 38.517 155.885 38.0109C156.212 37.5048 156.428 36.9355 156.52 36.34C156.588 35.8106 156.54 35.2729 156.381 34.7634C156.222 34.254 155.955 33.7848 155.598 33.388C155.241 32.9913 154.803 32.6761 154.313 32.4642C153.823 32.2523 153.294 32.1485 152.76 32.16Z"
          fill="white" />
        <path
          d="M152.28 40.5003C151.846 40.4997 151.414 40.4323 151 40.3003C150.103 40.0733 149.31 39.5474 148.752 38.8094C148.194 38.0714 147.904 37.1652 147.93 36.2403C147.989 35.2038 148.379 34.2136 149.043 33.4159C149.708 32.6182 150.611 32.0553 151.62 31.8103C151.992 31.7146 152.376 31.6675 152.76 31.6703C153.362 31.6582 153.959 31.7761 154.512 32.0158C155.064 32.2555 155.558 32.6115 155.961 33.0594C156.363 33.5073 156.664 34.0367 156.844 34.6115C157.023 35.1863 157.076 35.793 157 36.3903C156.917 37.0656 156.684 37.7137 156.317 38.2866C155.95 38.8595 155.459 39.3427 154.88 39.7003C154.109 40.2121 153.206 40.4899 152.28 40.5003ZM152.76 32.6703C152.46 32.6674 152.16 32.7044 151.87 32.7803C151.07 32.9696 150.353 33.4112 149.823 34.0396C149.294 34.6681 148.981 35.4501 148.93 36.2703C148.913 36.9787 149.141 37.6714 149.574 38.2321C150.007 38.7929 150.62 39.1876 151.31 39.3503C151.82 39.4839 152.353 39.5092 152.873 39.4246C153.394 39.3401 153.891 39.1475 154.333 38.8593C154.775 38.5711 155.151 38.1936 155.438 37.7512C155.725 37.3087 155.917 36.8111 156 36.2903C156.06 35.8337 156.022 35.3693 155.886 34.9291C155.751 34.4888 155.522 34.083 155.215 33.7393C154.909 33.3956 154.532 33.1222 154.109 32.9377C153.687 32.7532 153.231 32.662 152.77 32.6703H152.76Z"
          fill="#D7D7D7" />
        <path
          d="M240.12 134.59L260.79 129.35C260.01 127.87 247.45 90.1804 235.93 82.8504C226.04 74.6304 206.18 73.8504 183.69 72.9504C176.491 72.5291 169.271 73.2342 162.29 75.0404C136.06 82.2904 117.63 119.49 117.63 119.49L143.47 124.6C143.47 124.6 139.36 163.02 135.76 209.86C135.76 209.86 176.94 219.13 241.28 215.52C241.28 215.52 239.51 141.25 240.12 134.59Z"
          fill="#4DD783" />
        <path d="M177.22 86.0199L155.84 214.41L199.29 217.55L208.71 78.6699L177.22 86.0199Z" fill="#2A2A2A" />
        <path
          d="M199.29 218.05L155.85 214.91C155.78 214.904 155.712 214.885 155.651 214.852C155.589 214.819 155.534 214.774 155.49 214.72C155.408 214.608 155.372 214.468 155.39 214.33L176.77 85.9402C176.784 85.8439 176.827 85.754 176.893 85.6826C176.959 85.6111 177.045 85.5615 177.14 85.5402L208.64 78.1802C208.715 78.1607 208.794 78.1606 208.869 78.1799C208.944 78.1991 209.013 78.2371 209.07 78.2902C209.13 78.3393 209.178 78.4021 209.21 78.4734C209.241 78.5447 209.255 78.6224 209.25 78.7002L199.83 217.58C199.826 217.645 199.809 217.709 199.779 217.767C199.75 217.826 199.71 217.878 199.66 217.92C199.61 217.965 199.552 218 199.488 218.022C199.424 218.044 199.357 218.054 199.29 218.05ZM156.43 214L198.83 217.07L208.17 79.3502L177.65 86.4802L156.43 214Z"
          fill="#2A2A2A" />
        <path
          d="M180.08 67.2602L176.08 84.0302C176.08 84.0302 179.51 95.3402 190.88 94.4702C194.243 94.1846 197.5 93.1533 200.415 91.4512C203.33 89.7491 205.829 87.419 207.73 84.6302L212.62 53.7302C212.62 53.7302 205.21 48.0802 210.46 30.8502C200.882 33.2406 190.837 33.0092 181.38 30.1802C181.38 30.1802 173.31 48.4802 173.25 57.1802C173.19 65.8802 180.08 67.2602 180.08 67.2602Z"
          fill="white" />
        <path
          d="M189.69 95.0001C179.04 95.0001 175.69 84.2701 175.62 84.1501C175.6 84.0646 175.6 83.9756 175.62 83.8901L179.5 67.5801C177.85 67.0501 172.73 64.7501 172.78 57.1501C172.84 48.4501 180.62 30.7101 180.96 29.9601C181.007 29.8491 181.093 29.7591 181.201 29.7075C181.31 29.6558 181.434 29.6461 181.55 29.6801C190.92 32.4583 200.861 32.6895 210.35 30.3501C210.437 30.3263 210.529 30.3258 210.617 30.3486C210.705 30.3714 210.785 30.4167 210.85 30.4801C210.914 30.5441 210.96 30.6248 210.981 30.7131C211.002 30.8014 210.998 30.8938 210.97 30.9801C208.32 39.6901 208.97 45.3101 210.05 48.4901C210.577 50.3437 211.596 52.0198 213 53.3401C213.071 53.3944 213.125 53.4666 213.159 53.5492C213.192 53.6319 213.203 53.7219 213.19 53.8101L208.29 84.7101C208.283 84.7753 208.259 84.8376 208.22 84.8901C206.268 87.7501 203.706 90.1407 200.717 91.8892C197.729 93.6376 194.389 94.7002 190.94 95.0001C190.51 95.0001 190.09 95.0001 189.69 95.0001ZM176.62 84.0001C177.04 85.2701 180.53 94.7401 190.87 94.0001C194.133 93.7092 197.293 92.706 200.127 91.0611C202.961 89.4162 205.399 87.1698 207.27 84.4801L212.11 53.9601C210.85 52.8201 205.39 46.7901 209.75 31.5901C200.478 33.6763 190.832 33.4081 181.69 30.8101C180.51 33.5401 173.82 49.4201 173.77 57.2101C173.71 65.3601 179.92 66.7401 180.18 66.8001C180.247 66.8091 180.311 66.8337 180.366 66.8719C180.422 66.9101 180.468 66.9609 180.5 67.0201C180.538 67.0749 180.564 67.1371 180.576 67.2026C180.588 67.2681 180.586 67.3354 180.57 67.4001L176.62 84.0001Z"
          fill="#2A2A2A" />
        <path
          d="M206.32 52.15C206.925 50.7139 207.977 49.5111 209.32 48.72C210.619 48.0529 212.023 47.6132 213.47 47.42C214.253 47.2402 215.067 47.2402 215.85 47.42C216.386 47.5933 216.883 47.8721 217.31 48.24C218.4 49.0093 219.178 50.145 219.5 51.44C219.636 52.5011 219.509 53.5795 219.13 54.58C218.814 55.703 218.35 56.7791 217.75 57.78C217.127 58.7627 216.316 59.6119 215.362 60.2782C214.408 60.9444 213.331 61.4145 212.194 61.6611C211.057 61.9076 209.883 61.9258 208.739 61.7144C207.595 61.5031 206.504 61.0665 205.53 60.43"
          fill="white" />
        <path
          d="M210.39 62.3099C208.584 62.3125 206.816 61.7915 205.3 60.8099C205.19 60.7366 205.114 60.623 205.088 60.4937C205.062 60.3645 205.088 60.2301 205.16 60.1199C205.194 60.0638 205.24 60.0152 205.294 59.9771C205.348 59.939 205.409 59.9121 205.473 59.8981C205.537 59.8841 205.604 59.8832 205.669 59.8956C205.734 59.9079 205.795 59.9332 205.85 59.9699C206.768 60.5695 207.797 60.9806 208.875 61.1795C209.954 61.3784 211.061 61.3611 212.133 61.1285C213.204 60.8959 214.219 60.4527 215.118 59.8247C216.017 59.1966 216.783 58.3962 217.37 57.4699C217.946 56.5095 218.393 55.4773 218.7 54.3999C219.047 53.4716 219.167 52.4739 219.05 51.4899C218.744 50.3186 218.036 49.292 217.05 48.5899C216.671 48.2653 216.233 48.0174 215.76 47.8599C215.052 47.7011 214.318 47.7011 213.61 47.8599C212.215 48.0464 210.863 48.4691 209.61 49.1099C208.342 49.8343 207.348 50.9551 206.78 52.2999C206.727 52.4219 206.628 52.5178 206.504 52.5666C206.38 52.6154 206.242 52.6129 206.12 52.5599C205.998 52.5069 205.902 52.4075 205.853 52.2838C205.804 52.16 205.807 52.0219 205.86 51.8999C206.521 50.3586 207.665 49.074 209.12 48.2399C210.466 47.5384 211.925 47.0781 213.43 46.8799C214.284 46.6748 215.175 46.6748 216.03 46.8799C216.629 47.0709 217.183 47.3804 217.66 47.7899C218.839 48.6381 219.67 49.8852 220 51.2999C220.152 52.444 220.022 53.608 219.62 54.6899C219.303 55.8523 218.829 56.966 218.21 57.9999C217.55 59.0373 216.692 59.9343 215.684 60.6396C214.677 61.3448 213.541 61.8445 212.34 62.1099C211.699 62.2461 211.045 62.3132 210.39 62.3099Z"
          fill="#2A2A2A" />
        <path
          d="M178.5 75.6502C180.483 76.2077 182.562 76.3338 184.597 76.0198C186.633 75.7059 188.577 74.9592 190.3 73.8302C195.88 69.9702 195.9 67.2002 195.9 67.2002C195.9 67.2002 187.43 70.2002 180.49 67.5902L178.5 75.6502Z"
          fill="#2A2A2A" />
        <path
          d="M182.5 76.7C181.093 76.7115 179.692 76.5195 178.34 76.13C178.221 76.0908 178.121 76.0084 178.06 75.8992C177.999 75.7899 177.981 75.6618 178.01 75.54L180.01 67.47C180.052 67.3336 180.145 67.2189 180.27 67.15C180.333 67.123 180.401 67.1091 180.47 67.1091C180.539 67.1091 180.607 67.123 180.67 67.15C187.36 69.66 195.67 66.78 195.74 66.75C195.817 66.7243 195.898 66.7173 195.978 66.7294C196.058 66.7416 196.134 66.7726 196.2 66.82C196.266 66.865 196.319 66.9265 196.354 66.9984C196.39 67.0703 196.405 67.1501 196.4 67.23C196.4 67.35 196.31 70.29 190.59 74.23C188.213 75.8677 185.387 76.7304 182.5 76.7ZM179.1 75.3C180.949 75.7481 182.87 75.8124 184.745 75.4891C186.62 75.1657 188.408 74.4615 190 73.42C193.56 70.96 194.77 68.9699 195.18 67.9499C192.88 68.6199 186.5 70.14 180.83 68.25L179.1 75.3Z"
          fill="#2A2A2A" />
        <path d="M192.13 43C192.13 43 184.74 50.37 185.8 52.12C186.86 53.87 190.8 53.64 190.8 53.64" fill="white" />
        <path
          d="M190.33 54.0999C189.12 54.0999 186.33 53.9199 185.33 52.3299C184.16 50.3899 189.94 44.3899 191.74 42.5899C191.834 42.4958 191.962 42.4429 192.095 42.4429C192.228 42.4429 192.356 42.4958 192.45 42.5899C192.544 42.6841 192.597 42.8118 192.597 42.9449C192.597 43.0781 192.544 43.2058 192.45 43.2999C188.59 47.1499 185.72 51.0399 186.19 51.8099C186.93 53.0299 189.75 53.1499 190.77 53.0899C190.836 53.0859 190.902 53.0948 190.964 53.1162C191.026 53.1377 191.083 53.1712 191.133 53.2149C191.182 53.2585 191.222 53.3115 191.251 53.3707C191.279 53.4299 191.296 53.4942 191.3 53.5599C191.305 53.6259 191.298 53.6923 191.277 53.7551C191.256 53.8179 191.222 53.8758 191.178 53.9254C191.134 53.9749 191.081 54.015 191.021 54.0433C190.961 54.0716 190.896 54.0874 190.83 54.0899L190.33 54.0999Z"
          fill="#2A2A2A" />
        <path
          d="M200.525 43.8683C200.649 42.7596 200.109 41.789 199.318 41.7005C198.528 41.612 197.787 42.439 197.662 43.5477C197.538 44.6564 198.078 45.6269 198.869 45.7154C199.659 45.804 200.4 44.9769 200.525 43.8683Z"
          fill="#2A2A2A" />
        <path
          d="M187.101 41.7211C187.546 40.6982 187.316 39.6117 186.587 39.2942C185.858 38.9767 184.906 39.5484 184.46 40.5713C184.015 41.5941 184.245 42.6807 184.974 42.9982C185.703 43.3157 186.656 42.7439 187.101 41.7211Z"
          fill="#2A2A2A" />
        <path
          d="M197.71 62.7003C197.58 62.699 197.455 62.6491 197.36 62.5603C192.92 58.3003 180.92 55.6803 180.8 55.6503C180.736 55.6373 180.675 55.6115 180.621 55.5746C180.567 55.5377 180.521 55.4904 180.486 55.4354C180.45 55.3804 180.426 55.3189 180.415 55.2545C180.404 55.19 180.405 55.124 180.42 55.0603C180.433 54.9959 180.459 54.9348 180.495 54.8804C180.532 54.8259 180.579 54.7793 180.634 54.7431C180.689 54.7068 180.75 54.6818 180.815 54.6693C180.879 54.6568 180.946 54.6571 181.01 54.6703C181.51 54.7803 193.4 57.3803 198.01 61.8403C198.081 61.909 198.131 61.9974 198.152 62.0943C198.173 62.1911 198.164 62.292 198.128 62.3842C198.092 62.4763 198.029 62.5555 197.947 62.6118C197.865 62.6681 197.769 62.6989 197.67 62.7003H197.71Z"
          fill="#2A2A2A" />
        <path
          d="M259.8 170.21C259.692 170.211 259.586 170.176 259.5 170.11L244.75 158.79C244.645 158.707 244.577 158.587 244.558 158.455C244.539 158.323 244.572 158.189 244.65 158.08C244.733 157.978 244.851 157.911 244.982 157.894C245.112 157.878 245.244 157.912 245.35 157.99L260.11 169.32C260.191 169.385 260.249 169.473 260.278 169.572C260.306 169.671 260.303 169.777 260.269 169.874C260.235 169.972 260.172 170.057 260.088 170.117C260.004 170.177 259.903 170.209 259.8 170.21Z"
          fill="#2A2A2A" />
        <path
          d="M219.17 45.87H219.04C218.913 45.8349 218.805 45.7512 218.74 45.637C218.674 45.5227 218.656 45.3873 218.69 45.26C220.18 39.72 221.63 34.08 223 28.48L223.15 27.89C223.84 25.5357 224.223 23.1023 224.29 20.65C224.23 18.89 223.43 18.65 220.91 18.65C220.844 18.6523 220.777 18.6411 220.716 18.617C220.654 18.5929 220.597 18.5565 220.55 18.51C220.457 18.4171 220.403 18.2917 220.4 18.16C220.379 16.9275 220.076 15.7162 219.515 14.6189C218.953 13.5216 218.148 12.5676 217.16 11.83C213.82 9.38002 208.93 8.83002 203.73 10.46L203.47 10.54C198.29 12.12 193.82 13.48 188.16 13.69C187.07 13.69 185.94 13.69 184.85 13.69C182.389 13.5814 179.924 13.7457 177.5 14.18C175.987 14.555 174.5 15.0294 173.05 15.6C171.805 15.9732 170.637 16.5658 169.6 17.35C168.567 18.3551 167.765 19.5734 167.25 20.92C166.665 22.0969 166.244 23.3486 166 24.64C165.42 28.64 168 32.15 169.63 33.92C170.63 35.02 172.15 36.25 173.63 35.85C173.696 35.8323 173.764 35.8277 173.832 35.8364C173.899 35.8452 173.964 35.8671 174.023 35.901C174.082 35.9349 174.134 35.9801 174.175 36.034C174.217 36.0878 174.247 36.1494 174.265 36.215C174.283 36.2807 174.287 36.3492 174.279 36.4166C174.27 36.4841 174.248 36.5492 174.214 36.6081C174.18 36.6671 174.135 36.7188 174.081 36.7603C174.027 36.8018 173.966 36.8323 173.9 36.85C172.34 37.28 170.61 36.51 168.9 34.63C167.19 32.75 164.38 28.9 165.03 24.53C165.283 23.1407 165.731 21.7941 166.36 20.53C166.948 19.046 167.849 17.7057 169 16.6C170.127 15.7414 171.396 15.0881 172.75 14.67C174.241 14.0805 175.771 13.596 177.33 13.22C179.829 12.7625 182.372 12.5881 184.91 12.7C185.99 12.7 187.1 12.7 188.18 12.7C193.7 12.49 198.12 11.15 203.23 9.59002L203.49 9.51002C208.99 7.84002 214.2 8.40002 217.8 11.03C218.842 11.8128 219.706 12.8092 220.332 13.9527C220.958 15.0961 221.332 16.3601 221.43 17.66C223.23 17.66 225.25 17.86 225.34 20.66C225.278 23.2036 224.885 25.7282 224.17 28.17L224.02 28.76C222.65 34.36 221.19 40.01 219.7 45.56C219.659 45.6633 219.584 45.7498 219.488 45.806C219.392 45.8621 219.28 45.8846 219.17 45.87Z"
          fill="#2A2A2A" />
        <path
          d="M202.71 87.51C202.71 87.51 197.06 82.09 195.56 75.46C194.06 68.83 194.64 67.4 193.61 67.17C192.58 66.94 190.84 67.64 189.55 69.9C188.26 72.16 188.61 80.11 190.71 83.31C192.81 86.51 202.71 87.51 202.71 87.51Z"
          fill="white" />
        <path
          d="M202.71 88.0002H202.66C202.25 87.9502 192.5 86.9302 190.29 83.5702C188.08 80.2102 187.7 72.1002 189.12 69.6402C190.54 67.1802 192.42 66.3902 193.71 66.6402C194.64 66.8402 194.71 67.6402 194.98 69.3302C195.15 70.5702 195.4 72.4502 196.05 75.3302C197.5 81.7302 203 87.0802 203.05 87.1302C203.122 87.2042 203.17 87.2976 203.19 87.3988C203.209 87.5001 203.199 87.6048 203.16 87.7002C203.121 87.7874 203.058 87.8617 202.978 87.9148C202.898 87.9678 202.806 87.9974 202.71 88.0002ZM193.23 67.6302C192.42 67.6302 191.06 68.2502 189.98 70.1302C188.9 72.0102 189.08 79.9102 191.13 83.0202C192.51 85.1302 198.13 86.3502 201.38 86.8302C199.66 84.9302 196.22 80.6202 195.08 75.5602C194.42 72.6602 194.16 70.7502 193.99 69.4902C193.79 68.0402 193.72 67.7002 193.5 67.6502C193.411 67.6362 193.32 67.6328 193.23 67.6402V67.6302Z"
          fill="#2A2A2A" />
        <path
          d="M119.2 120.19C119.2 120.19 94.08 182 103.5 200.8C112.92 219.6 205.57 228 205.57 228C205.57 228 217.35 233 221.01 233.76C224.67 234.52 238.55 235.33 238.55 235.33C238.55 235.33 233.31 236.33 235.14 237.94C236.97 239.55 247.14 239.51 248.23 235.85C249.32 232.19 246.4 217.53 243.23 215.17C240.06 212.81 204.49 204.17 201.88 203.92C199.27 203.67 140.64 183.33 140.64 183.33L148.23 125.93"
          fill="white" />
        <path
          d="M240.15 239.46C237.82 239.46 235.67 239.07 234.82 238.34C234.61 238.198 234.447 237.997 234.353 237.761C234.258 237.526 234.236 237.268 234.29 237.02C234.435 236.706 234.643 236.425 234.901 236.195C235.159 235.964 235.462 235.789 235.79 235.68C231.54 235.41 223.6 234.84 220.91 234.26C217.35 233.5 206.53 228.96 205.45 228.51C200.67 228.07 112.45 219.79 103.05 201.02C99.0499 193.09 100.53 177.02 107.34 153.29C112.34 135.67 118.68 120.16 118.74 120C118.79 119.877 118.888 119.779 119.01 119.727C119.133 119.676 119.272 119.675 119.395 119.725C119.518 119.776 119.616 119.873 119.668 119.996C119.72 120.119 119.72 120.257 119.67 120.38C119.42 121 94.7399 182.15 103.95 200.58C113.16 219.01 204.69 227.44 205.62 227.52C205.666 227.51 205.714 227.51 205.76 227.52C205.88 227.57 217.54 232.52 221.12 233.25C224.7 233.98 238.44 234.8 238.58 234.81C238.701 234.817 238.815 234.868 238.901 234.952C238.988 235.037 239.04 235.15 239.05 235.27C239.055 235.391 239.019 235.511 238.946 235.607C238.872 235.704 238.768 235.772 238.65 235.8C237.14 236.1 235.38 236.8 235.26 237.24C235.26 237.31 235.35 237.44 235.47 237.54C236.47 238.4 241.27 238.88 244.85 237.81C245.99 237.46 247.43 236.81 247.75 235.69C248.81 231.99 245.75 217.69 242.96 215.55C240.17 213.41 205.03 204.71 201.86 204.4C199.21 204.13 142.86 184.61 140.5 183.78C140.392 183.744 140.3 183.671 140.24 183.575C140.179 183.478 140.155 183.363 140.17 183.25L147.76 125.84C147.768 125.775 147.79 125.711 147.823 125.654C147.856 125.597 147.9 125.546 147.952 125.506C148.005 125.465 148.065 125.436 148.129 125.418C148.193 125.401 148.259 125.397 148.325 125.405C148.391 125.414 148.454 125.435 148.511 125.468C148.569 125.501 148.619 125.545 148.659 125.598C148.7 125.65 148.729 125.71 148.747 125.774C148.764 125.838 148.768 125.905 148.76 125.97L141.22 182.97C161.59 190.03 199.96 203.2 201.97 203.4C203.98 203.6 240.14 212.18 243.57 214.75C247 217.32 249.79 232.22 248.72 235.97C248.37 237.2 247.13 238.17 245.15 238.77C243.524 239.232 241.841 239.464 240.15 239.46Z"
          fill="#2A2A2A" />
        <path
          d="M225.46 138.25C225.46 138.25 208.59 95.0501 203.85 87.9401C199.11 80.8301 178.31 63.4701 175.72 65.2001C173.13 66.9301 173.89 68.8601 174.97 70.2001C176.05 71.5401 182.08 75.6901 182.08 75.6901C182.08 75.6901 175.29 72.5701 175.08 76.6901C174.87 80.8101 180.08 83.2701 180.08 83.2701C180.08 83.2701 174.37 79.0601 174.15 83.5901C174.121 84.9111 174.487 86.2108 175.199 87.3237C175.911 88.4367 176.938 89.3126 178.15 89.8401C178.15 89.8401 172.07 84.6801 172.65 90.0601C173.65 98.9001 191.41 109.46 191.41 109.46L198.95 182.93C198.95 182.93 201.65 225.54 228.84 224.25C263.73 222.59 273.84 172.25 256.4 129.68"
          fill="white" />
        <path
          d="M227.58 224.71C201.34 224.71 198.42 183.31 198.39 182.89L190.88 109.69C188.74 108.39 173.04 98.5903 172.1 90.0403C171.94 88.5803 172.24 87.6403 172.99 87.2403C173.445 87.0228 173.965 86.9801 174.45 87.1203C173.82 86.0222 173.525 84.764 173.6 83.5003C173.564 83.0277 173.663 82.5547 173.884 82.1354C174.105 81.7162 174.44 81.3679 174.85 81.1303C175.293 80.9384 175.782 80.876 176.26 80.9503C175.144 79.7805 174.537 78.2166 174.57 76.6003C174.567 76.1734 174.672 75.7525 174.874 75.3767C175.077 75.0009 175.371 74.6823 175.73 74.4503C176.802 73.9598 178.014 73.8642 179.15 74.1803C177.534 73.0663 176.006 71.8293 174.58 70.4803C174.164 70.0937 173.848 69.6112 173.661 69.075C173.474 68.5388 173.42 67.9649 173.505 67.4033C173.59 66.8416 173.81 66.3091 174.147 65.852C174.485 65.3949 174.928 65.0271 175.44 64.7803C177.34 63.5103 184.94 69.3003 189.29 72.8703C194.9 77.4603 201.7 83.8203 204.29 87.6603C209 94.7403 225.29 136.3 225.95 138.07C225.995 138.194 225.991 138.33 225.936 138.45C225.882 138.57 225.783 138.663 225.66 138.71C225.6 138.736 225.535 138.749 225.469 138.749C225.404 138.748 225.339 138.735 225.279 138.708C225.22 138.682 225.166 138.644 225.121 138.596C225.076 138.548 225.042 138.492 225.02 138.43C224.85 138 208.11 95.2103 203.45 88.2203C201.28 84.9603 195.35 79.1003 188.68 73.6403C180.61 67.0303 176.68 65.2003 176.02 65.6403C175.644 65.8398 175.316 66.1168 175.055 66.453C174.795 66.7892 174.609 67.1769 174.51 67.5903C174.493 68.0072 174.56 68.4232 174.708 68.8133C174.855 69.2035 175.081 69.5596 175.37 69.8603C176.22 70.8603 180.72 74.1003 182.37 75.2603C182.471 75.333 182.542 75.441 182.568 75.5632C182.594 75.6853 182.573 75.8127 182.51 75.9203C182.45 76.0305 182.351 76.1137 182.232 76.1527C182.113 76.1918 181.983 76.1838 181.87 76.1303C180.77 75.6203 177.62 74.5003 176.25 75.3303C176.031 75.4763 175.853 75.6764 175.734 75.9111C175.615 76.1458 175.558 76.4074 175.57 76.6703C175.45 78.9903 177.27 80.7703 178.68 81.8003C179.254 82.0913 179.806 82.4256 180.33 82.8003C180.425 82.8759 180.489 82.9832 180.51 83.1025C180.532 83.2217 180.509 83.3447 180.447 83.4487C180.385 83.5526 180.287 83.6303 180.171 83.6674C180.056 83.7045 179.931 83.6984 179.82 83.6503C179.231 83.3625 178.666 83.0281 178.13 82.6503C177.13 82.1203 175.94 81.7603 175.28 82.0703C174.87 82.2603 174.64 82.7703 174.6 83.5803C174.553 84.3683 174.671 85.1575 174.949 85.8965C175.226 86.6356 175.656 87.3081 176.21 87.8703C176.988 88.3246 177.728 88.8431 178.42 89.4203C178.51 89.4978 178.569 89.6047 178.588 89.722C178.606 89.8392 178.582 89.9591 178.52 90.0603C178.458 90.1623 178.361 90.2385 178.247 90.2752C178.133 90.3119 178.01 90.3066 177.9 90.2603C177.075 89.886 176.323 89.3679 175.68 88.7303C174.77 88.2203 173.91 87.9103 173.46 88.1503C173.01 88.3903 172.98 88.9803 173.09 89.9603C174.02 98.4503 191.43 108.88 191.6 108.96C191.668 109 191.726 109.055 191.77 109.121C191.813 109.187 191.84 109.262 191.85 109.34L199.39 182.81C199.39 183.25 202.33 224.96 228.75 223.68C239.7 223.16 248.8 217.68 255.09 207.8C267.01 189.09 267.33 157.74 255.88 129.8C255.833 129.678 255.835 129.542 255.885 129.421C255.935 129.3 256.03 129.203 256.15 129.15C256.274 129.103 256.411 129.104 256.533 129.154C256.656 129.205 256.755 129.3 256.81 129.42C268.37 157.65 268.02 189.36 255.93 208.34C249.47 218.49 240.08 224.14 228.8 224.68L227.58 224.71Z"
          fill="#2A2A2A" />
        <path d="M224.59 136.59C224.59 136.59 238.2 173.59 241.69 185.79L224.59 136.59Z" fill="white" />
        <path
          d="M241.69 186.29C241.581 186.292 241.475 186.257 241.388 186.192C241.302 186.127 241.239 186.035 241.21 185.93C237.76 173.88 224.26 137.13 224.12 136.76C224.096 136.698 224.084 136.631 224.085 136.564C224.087 136.498 224.102 136.432 224.13 136.371C224.157 136.31 224.197 136.255 224.246 136.21C224.295 136.164 224.352 136.129 224.415 136.106C224.478 136.084 224.545 136.074 224.612 136.077C224.678 136.081 224.744 136.098 224.804 136.127C224.864 136.156 224.918 136.197 224.962 136.248C225.006 136.298 225.039 136.356 225.06 136.42C225.19 136.79 238.71 173.57 242.17 185.66C242.204 185.787 242.188 185.923 242.125 186.038C242.062 186.154 241.956 186.241 241.83 186.28L241.69 186.29Z"
          fill="#2A2A2A" />
        <path d="M150.44 101C150.44 102.05 148.34 121.59 148.34 121.59L150.44 101Z" fill="#2A2A2A" />
        <path
          d="M148.34 122.08H148.29C148.159 122.065 148.039 121.999 147.957 121.896C147.874 121.793 147.836 121.661 147.85 121.53C148.43 116.11 149.94 101.84 149.94 101C149.94 100.867 149.993 100.74 150.086 100.646C150.18 100.553 150.307 100.5 150.44 100.5C150.573 100.5 150.7 100.553 150.794 100.646C150.887 100.74 150.94 100.867 150.94 101C150.94 102.06 148.94 120.84 148.85 121.64C148.835 121.764 148.775 121.877 148.68 121.959C148.586 122.04 148.465 122.083 148.34 122.08Z"
          fill="#2A2A2A" />
        <path
          d="M60.4799 63.9403C59.8999 56.4703 62.8399 51.5603 71.1299 45.6203C78.5999 40.3603 80.7299 37.6203 80.4099 33.4503C80.0199 28.4503 75.4999 25.7003 68.7599 26.2203C60.4299 26.8703 55.7099 32.6503 55.8399 42.2203L37.6099 42.2803C36.8099 23.9903 48.7399 11.1103 67.6099 9.65035C84.3899 8.35035 97.4199 17.5603 98.4899 31.4003C99.1499 39.8503 95.4899 46.1703 86.1199 52.9303C78.5499 58.5703 76.8799 60.7903 77.2099 65.0803L77.5399 69.3703L60.9999 70.6803L60.4799 63.9403ZM60.4799 79.2203L79.9999 77.7003L81.4699 96.7003L61.8999 98.2003L60.4799 79.2203Z"
          fill="black" />
        <path
          d="M162.85 44.47C165.72 45.05 166.03 40.14 163 40.69C162.552 40.7499 162.139 40.966 161.835 41.3002C161.531 41.6344 161.354 42.0653 161.336 42.517C161.318 42.9687 161.46 43.4122 161.737 43.7695C162.014 44.1267 162.408 44.3748 162.85 44.47Z"
          fill="white" />
        <path
          d="M163.31 45.0001C163.122 44.9994 162.934 44.9793 162.75 44.9401C162.203 44.8532 161.707 44.5714 161.352 44.1468C160.997 43.7221 160.808 43.1833 160.82 42.6301C160.824 42.0409 161.036 41.472 161.418 41.0238C161.8 40.5755 162.329 40.2767 162.91 40.1801C163.343 40.069 163.8 40.0939 164.219 40.2513C164.637 40.4088 164.997 40.6911 165.25 41.0601C165.53 41.5137 165.671 42.0392 165.657 42.572C165.643 43.1049 165.474 43.622 165.17 44.0601C164.963 44.3596 164.684 44.6026 164.36 44.7667C164.035 44.9309 163.674 45.0112 163.31 45.0001ZM163 44.0001C163.257 44.075 163.532 44.0659 163.783 43.9742C164.035 43.8825 164.251 43.7129 164.4 43.4901C164.578 43.2165 164.677 42.8995 164.688 42.5734C164.698 42.2474 164.619 41.9247 164.46 41.6401C164.313 41.4387 164.107 41.2881 163.87 41.2093C163.634 41.1304 163.378 41.1272 163.14 41.2001C162.789 41.2605 162.47 41.4414 162.239 41.7115C162.007 41.9817 161.876 42.3242 161.87 42.6801C161.86 43.0013 161.97 43.3147 162.179 43.5589C162.388 43.803 162.681 43.9604 163 44.0001Z"
          fill="#D7D7D7" />
        <path
          d="M64.9199 172C65.0472 170.312 64.6415 168.626 63.7599 167.18C62.8952 166.202 62.0808 165.181 61.3199 164.12C60.3199 162.12 61.0099 159.85 60.7699 157.7C60.5294 155.847 59.623 154.144 58.2199 152.91C56.9499 151.77 55.3199 150.99 54.0999 149.8C52.0999 147.86 51.5399 145.12 50.4099 142.69C48.6924 139.144 45.8904 136.237 42.4099 134.39C44.5799 138.26 39.6399 143.18 41.8799 147.02C42.5899 148.23 43.9399 149.12 44.4599 150.41C45.7199 153.52 41.5399 156.89 42.8699 159.98C43.5399 161.52 45.4099 162.41 46.2699 163.87C47.4399 165.87 46.5199 168.23 46.6199 170.46C46.7499 173.53 48.8599 176.27 51.3599 178.4C52.9199 179.72 54.6499 180.87 56.3599 182.06C58.3599 183.49 59.2299 185 60.9999 182.7C63.4146 179.643 64.7881 175.894 64.9199 172Z"
          fill="#D7D7D7" />
        <path
          d="M69.4199 173.45C68.7699 171.07 68.3099 168.5 69.4199 166.26C70.6599 163.72 73.7299 161.93 74.0899 159.19C74.3299 157.39 73.2999 155.57 73.6999 153.8C74.0999 152.03 75.6999 150.8 77.0899 149.51C80.132 146.615 81.9951 142.697 82.3199 138.51C84.3751 140.653 86.0643 143.12 87.3199 145.81C87.9157 147.131 88.1615 148.583 88.0337 150.026C87.9058 151.469 87.4086 152.855 86.5899 154.05C86.0823 154.595 85.6578 155.212 85.3299 155.88C84.7199 157.63 86.4099 159.26 87.3299 160.88C87.846 161.816 88.0641 162.887 87.9551 163.951C87.8461 165.014 87.4152 166.018 86.7199 166.83C84.9499 168.83 81.5399 169.55 80.7199 171.93C80.5013 172.817 80.3971 173.727 80.4099 174.64C80.1508 176.294 79.3968 177.831 78.2473 179.049C77.0978 180.266 75.6065 181.107 73.9699 181.46C71.8699 181.9 71.9699 181.17 71.5399 179.61C70.8999 177.57 69.9999 175.54 69.4199 173.45Z"
          fill="#D7D7D7" />
        <path
          d="M62.76 156.37C61.27 151.81 60.67 147.04 59.11 142.5C57.763 138.93 56.1345 135.472 54.24 132.16L60.62 134.54C62.62 135.31 64.88 136.21 65.85 137.98C67.53 141.07 64.51 145.03 66.27 148.08C67.0403 149.08 67.8861 150.02 68.8 150.89C70.68 153.23 70.39 156.45 69.36 159.17C68.92 160.34 66.98 166.4 65.25 164.72C64.56 164.04 64.5 161.53 64.25 160.61C63.77 159.19 63.22 157.79 62.76 156.37Z"
          fill="#D7D7D7" />
        <path
          d="M61.84 198.57C60.72 190.32 59.75 183.16 59.74 183.04L58.74 183.17C58.74 183.29 59.74 190.37 60.82 198.57H61.84Z"
          fill="#D7D7D7" />
        <path
          d="M70.46 198.57C71.83 187.91 73.25 180 74.05 179.12L73.31 178.45C72.2 179.67 70.7 188.92 69.46 198.57H70.46Z"
          fill="#D7D7D7" />
        <path
          d="M69.24 198.57C68.15 179.3 66.24 160.18 66.24 159.93L65.24 160.03C65.24 160.28 67.24 179.35 68.24 198.57H69.24Z"
          fill="#D7D7D7" />
        <path
          d="M51.9199 187.12H80.1999L78.1999 208.38C77.8599 212.06 73.7399 214.92 68.7799 214.92H63.3099C58.3099 214.92 54.2299 212.06 53.8799 208.38L51.9199 187.12Z"
          fill="#D7D7D7" />
      </svg>

    </div>
  </div>
  @endif
</div>