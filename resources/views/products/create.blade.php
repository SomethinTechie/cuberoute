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
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="" style="width: 35%;margin: 0 auto;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 20px;">
                <div class="header-title">
                    <strong>Create a Products</strong>
                </div>
                <div class="productForm">
                    <form id="newProductForm" method="POST" action="{{ route('store_product') }}">
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
                        @if ($successmessage)
                            <div class="alert alert-danger">
                                <li>{{ $successmessage }}</li>
                            </div>
                        @endif
                        <!-- Email Address -->
                        <div class="form-group">
                            <div class="input-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <input name="name" type="text" class="ui-input" placeholder="" value="{{ old('name') }}">
                            </div>
                            <div class="input-group">
                                <x-input-label for="title" :value="__('Title')" />
                                <input name="title" type="text" class="ui-input" placeholder="" value="{{ old('title') }}">
                            </div>
                            <div class="input-group">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description" type="text" class="ui-input" placeholder="255 words only."  value="{{ old('description') }}"></textarea>
                            </div>
                            <div class="input-group">
                                <x-input-label for="keywords" :value="__('Keywords')" />
                                <input name="keywords" type="text" class="ui-input" placeholder=""  value="{{ old('keywords') }}">
                            </div>

                            <div class="categories" style="width: 100%;display: block;float:left"></div>
                            <div class="input-group">
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category_id" type="text" class="ui-input" placeholder=""  value="{{ old('category') }}">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="variations" style="width: 100%;display: block;float:left"></div>

                            <div class="input-group" style="width: 45%;float:left">
                                <x-input-label for="variation name" :value="__('Variation name')" />
                                <input id="vName" name="" type="text" class="ui-input" placeholder=""  value="{{ old('') }}" style="border-radius: 6px 0 0 6px!important;">
                            </div>

                            <div class="input-group" style="width: 45%;float:left">
                                <x-input-label for="variation name" :value="__('Variation value')" />
                                <input id="vValue" name="" type="text" class="ui-input" placeholder=""  value="{{ old('variationValue') }}" style="border-radius: 0!important;">
                            </div>

                            <div class="input-group" style="width: 10%;float:left;height: 42px;display: flex;align-items: center;justify-content: center;border: solid 1px #eee;margin-top: 25px;border-radius: 0 6px 6px 0;border-left: none;cursor:pointer;">
                                <i class="bi bi-plus" onclick="addVariation()" style="font-size: 20px;"></i>
                            </div>

                            <div class="input-group" style="margin-top: 20px;float:left">
                                <input type="submit" class="ui-input stdBtn" value="Create Product">
                            </div>
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


    $("#category").on('change', function() {
        var category_id = $('#category').val()
        console.log($(this).val())

        $('.categories').append(`
            <span class="variation-tag"><i class="bi bi-x"></i>${category_id}</div>
        `)
    })
</script>
