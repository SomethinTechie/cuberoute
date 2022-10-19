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
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="" style="width: 30%;margin: 0 auto;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 20px;">
                <div class="header-title">
                    <strong>Create a Products</strong>
                </div>
                <div class="productForm">
                    <form method="POST" action="{{ route('store_product') }}">
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
                            <div class="input-group">
                                <x-input-label for="category" :value="__('Category')" />
                                <select name="category_id" type="text" class="ui-input" placeholder=""  value="{{ old('category') }}">
                                    @foreach ($product as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
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
</script>
