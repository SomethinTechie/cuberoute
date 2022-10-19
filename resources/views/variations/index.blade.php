<style>
    .products-nav {
        width: 100%;
        padding: 10px 0;
        height: auto;
        border-bottom: solid 1px #eee;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .products-nav a {
        display: inline-block;
        list-style: none;
        padding: 10px 20px;
        border-radius: 4px;
        margin: 0 2px;
    }
    .products-nav a:hover {
        background: #007bff;
        color: #ffff;
        cursor: pointer;
    }
    .products-nav a.active {
        background: #007bff;
        color: #ffff;
    }
    .list {
        width: 100%;
        background: #f9f9f9;
        float: left;
    }
    .list-item  {
        width: 100%;
        height: auto;
        float: left;
        padding: 10px 20px;
        display: flex!important;
        align-items: center;
        justify-content: space-between;
        border-bottom: solid 1px #eee;
    }
    .list-item:hover {
        cursor: pointer;
        background: #f7f7f7;
    }
    .left, .right {
        display: flex;
        align-items: center;
    }
    i {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border: solid 1px #eee;
        border-radius: 6px;
        margin: 0 2px;
        color: #000;
    }
    i:hover {
        background: #007bff;
        color: #fff;
        border: solid transparent;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- You're logged in! --}}
                <div class="products-nav" style="height: 60px;padding-right: 0;">
                    <div class="left">
                        Variations
                    </div>
                    {{-- <div class="right">
                        <a href="{{ route('create_variant') }}" style="background: transparent;"><i class="bi bi-plus" style="font-size: 20px;border-radius: 40px;"></i></a>
                    </div> --}}
                </div>
                <div class="list">
                    @if (count($variations) > 0)
                        @foreach ($variations as $variation)
                            <div class="list-item">
                                <div class="left">
                                    {{ $variation->variationName }}
                                </div>
                                <div class="right">
                                    {{-- <a href="{{ route('show_product',$variation->id) }}"><i class="bi bi-eye"></i></a> --}}
                                    <a href="{{ route('edit_product',$variation->id) }}"><i class="bi bi-pen"></i></a>
                                    <a href="{{ route('delete_product',$variation->id) }}"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="padding: 20px;">No variations stored</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(".products-nav a").on("click", function() {
        $(this).addClass('active')
        console.log('category')
    });
</script>
