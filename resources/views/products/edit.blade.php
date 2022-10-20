<style>
    .header-title {
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        padding: 0 20px;
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
        border-radius: 6px;
    }
    .input-group {
        margin-top: 5px;
    }
    .variation-tag {
        padding: 5px 15px;
        background: #f8f9fa;
        color: #007bff;
        font-size: 12px;
        border-radius: 6px;
        margin: 20px 1px 5px 1px;
        float: left;
        display: flex;
    }
    .variation-tag i {
        width: 16px;
        height: 16px;
        background: #007bff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin-right: 10px;
        margin-left: -10px;
        cursor: pointer;
    }
    .deleteVariationBtn {
        width: 30px;
        height: 30px;
        background: #007bff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin-right: 10px;
        margin-left: -10px;
        cursor: pointer;
        position: absolute;
        right: 0px;
        top: 30px;
        cursor: pointer;
    }
    label {
        margin-top: 5px;
        float: left;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="" style="width: 50%;margin: 0 auto;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 20px;">
                <div class="header-title">
                    <a href="{{ route('dashboard') }}" style="width: 40px;height: 40px;display: flex;align-items: center;justify-content: center;border: solid 1px #777; border-radius: 6px;margin-right: 20px;"><i class="bi bi-arrow-left"></i></a>
                    <strong>Update Products</strong>
                </div>
                <div class="productForm">
                    <form id="newProductForm" method="POST" action="{{ route('update_product',$product->id) }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="input-group"style="font-size: 30px;margin-bottom: 20px;text-transform: capitalize;">
                                <h1>{{ $product->name }} </h1>
                                <input type="hidden" name="name" value='{{ $product->name }}'>
                            </div>
                            <div class="input-group">
                                <x-input-label for="title" :value="__('Title')" />
                                <input name="title" type="text" class="ui-input" value="{{ $product->title }}">
                            </div>
                            <div class="input-group">
                                <x-input-label for="description" :value="__('description')" />
                                <input name="description" type="text" class="ui-input" value="{{ $product->description }}">
                            </div>
                            <div class="input-group">
                                <x-input-label for="keywords" :value="__('keywords')" />
                                <input name="keywords" type="text" class="ui-input" value="{{ $product->keywords }}">
                            </div>
                            
                            <h3 class="" style="width: 100%;padding: 20px 0;margin-top: 20px;font-weight: bolder">Product Variations</h3>

                            
                                @if(count($product->variations ) > 0)
                                    @foreach($product->variations as $variation)
                                        <label for="">{{ $variation->variationName }}</label>
                                        <div class="input-group" style="position: relative;">
                                            <input name="{{ $variation->variationName }}" type="text" class="ui-input" value="{{ $variation->value }}">
                                            
                                            <a href="{{ route('delete_variation',$variation->id) }}">
                                                <i class="bi bi-trash deleteVariationBtn" onclick="deleteVariation('delete{{ $variation->variationName }}')"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    No variations for this product.
                                @endif

                            <h3 class="" style="width: 100%;padding: 20px 0;margin-top: 20px;font-weight: bolder;">Product Category</h3>

                            <div class="input-group">
                                @if(count($categories) > 0)
                                    <x-input-label for="category" :value="__('Category name')" />
                                    @foreach($categories as $category)
                                        <input name="category_name" type="text" class="ui-input" value="{{ $category->name }}">
                                    @endforeach
                                @else
                                    <p style="width: 100%;float: left;margin-bottom: 30px;">No catagory</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" value="Update product" class="stdBtn">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(".activeTab").addClass("active");
    function addVariation() {
        var name = $("#vName").val()
        var value = $("#vValue").val()
        $('#newProductForm').append(`
                <input name="${name}" type="hidden" class="ui-input" value="${value}">
            `)
        $('.variations').append(`
            <span class="variation-tag"><i class="bi bi-x"></i>${name}: ${value}</div>
        `)
        $("#vName").val('')
        $("#vValue").val('')
    }

    function deleteVariation(form) {
        console.log($(`#${form}`))
        // $(`#${form}`).submit()
        console.log($(this).parent().submit())
    }
</script>
