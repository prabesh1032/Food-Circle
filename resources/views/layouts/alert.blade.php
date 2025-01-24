@if(Session::has('success'))
<div class="fixed left-4 bottom-4 bg-cyan-100 px-5 py-3 rounded-md shadow-lg border-l-8
    border-yellow-500 z-20" id="alertmessage">
    <p class="text-cyan-800 text-center text-xl font-bold">
        <i class="ri-check-double-line text-yellow-500 text-3xl"></i><br>
        {{ session('success') }}.
    </p>
</div>
<script>
    setTimeout(function() {
        document.getElementById('alertmessage').style.display = 'none';
    }, 2000);
</script>
@endif

@if(Session::has('error'))
<div class="fixed left-4 bottom-4 bg-cyan-100 px-5 py-3 rounded-md shadow-lg border-l-8
    border-red-500 z-20" id="alertmessage">
    <p class="text-red-800 text-center text-xl font-bold">
        <i class="ri-error-warning-line text-red-500 text-3xl"></i><br>
        {{ session('error') }}.
    </p>
</div>
<script>
    setTimeout(function() {
        document.getElementById('alertmessage').style.display = 'none';
    }, 2000);
</script>
@endif
