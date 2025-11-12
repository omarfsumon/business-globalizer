<?php
/**
 * Custom search form template
 */
?>
<form role="search" method="get" class="max-w-md mx-auto w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">
        <?php _e( 'Search', 'globalizer' ); ?>
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input 
            type="search" 
            id="default-search" 
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 focus:border-blue-500" 
            placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'globalizer' ); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        />
        <button 
            type="submit" 
            class="text-white absolute end-0 bottom-[1px] bg-blue-600 hover:bg-blue-700 focus:outline-none font-medium rounded text-sm px-6 py-4"
        >
            <?php _e( 'Search', 'globalizer' ); ?>
        </button>
    </div>
</form>