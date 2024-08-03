<div id="alert-box"
    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded absolute top-0 left-1/2 transform -translate-x-1/2 m-4"
    role="alert">
    <span class="block sm:inline me-8">{{$message}}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <title>Close</title>
            <path
                d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.93 2.93a1 1 0 11-1.414 1.414L10 11.414l-2.93 2.93a1 1 0 11-1.414-1.414L8.586 10 5.656 7.07a1 1 0 111.414-1.414L10 8.586l2.93-2.93a1 1 0 011.414 0z"
                clip-rule="evenodd" fill-rule="evenodd"></path>
        </svg>
    </span>
</div>

<script>
    function closeAlert() {
        document.getElementById('alert-box').style.display = 'none';
    }
    setTimeout(closeAlert, 3000);
</script>
