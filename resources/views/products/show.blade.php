<style>
    .header-title {
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        float: left;
    }
    .productForm {
        padding: 20px;
    }
    .ui-input {
        width: 100%;
        border: solid 1px #eee!important;
        border-radius: 6px!important;
    }
    .stdBtn {
        padding: 10px 20px;
        background: #007bff!important;
        color: #fff;
    }
    .input-group {
        margin-top: 5px;
    }

    .product-img {
        width: 30%;
        height: 400px;
        float: left;
        background: #eee;
    }
    .product-details {
        width: 70%;
        height: 450px;
        float: left;
        padding: 0 40px;
    }
    .pc {
        display: block;
        float: left;
        width: 100%;
    }
    .list-item {
        list-style: none;
        padding: 20px 0;
        float: left;
    }
    .catalog {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 0;
    }
    .catalogproduct {
        width: 140px;
        height: 140px;
        border-radius: 6px;
        position: relative;
        float: left;
        background: #f7f7f7;
    }
    .catalogproduct .name {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 10px 20px;
    }
    .variants-nav {
        width: 100%;
        float: left;
        display: flex;
        align-items: center;
        justify-content: left;
        height: 30px;
        border: solid 1px #eee;
        margin: 20px 0;
        padding: 20px 5px;
        border-radius: 6px;
    }
    .variants-nav a {
        padding: 5px 20px;
        font-size: 10px;
        margin: 2px;
        border-radius: 4px;
        border: solid 1px #eee;
    }
    .variants-nav a:hover {
        border: solid 1px transparent;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="" style="width: 85%;margin: 0 auto;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 20px;">
                <div class="header-title" style="margin-bottom: 20px;padding-left: 0;">
                    <a href="{{ route('dashboard') }}" style="width: 40px;height: 40px;display: flex;align-items: center;justify-content: center;border: solid 1px #777; border-radius: 6px;margin-right: 20px;"><i class="bi bi-arrow-left"></i></a><strong>Product</strong>
                </div>
                <div class="product-img"></div>
                <div class="product-details">
                    <div class="title"><h1 style="font-size: 30px;">{{ $product->name }}</h1><small class="pc">{{ $product->category->name }}</small></div>
                    <div class="variants-nav">
                        @if (count($productVariations) > 0)
                            @foreach($productVariations as $variation)
                                <a href="">{{ $variation->variationName }}: {{ $variation->value }}</a>
                            @endforeach
                        @else
                            <p style="padding: 0 10px;">No product variations available</p>
                        @endif
                    </div>

                    <div class="title" style="margin: 30px 0;">
                        {{ $product->description }}
                    </div>

                    <div class="title">
                        Other products
                    </div>
                    <div class="catalog">
                        @if ($sameCategoryProducts)
                            @foreach ($sameCategoryProducts as $product)
                                <a href="{{ route('show_product',$product->id) }}" class="catalogproduct">
                                    <div class="name">{{ $product->name }}</div>
                                </a>
                            @endforeach
                        @else
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(".activeTab").addClass("active");
</script>
