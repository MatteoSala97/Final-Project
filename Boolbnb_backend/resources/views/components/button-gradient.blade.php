<button-gradient
    {{ $attributes->merge(['class' => 'inline-flex items-center px-10 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm uppercase']) }}>
    {{ $slot }}
</button-gradient>

<style>
    button-gradient{
        background-image: linear-gradient(135deg, #00A9BF, #A336DF);
    }
    button-gradient:hover {
        background-image: linear-gradient(135deg, #008c9e, #8a1bc5);
    }

    /* .gradient-button {
        background-image: linear-gradient(135deg, #00CBD8, #B844FF);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    } */

</style>
