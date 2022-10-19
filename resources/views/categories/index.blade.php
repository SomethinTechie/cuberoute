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
    .ui-input {
        width: 80%;
    }
    input[type="submit"] {
        width: 18%;
        background: #007bff;
        color: #fff;
        padding: 9px 20px;
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
                        Categories
                    </div>
                    
                </div>
                <div class="categoryForm" style="padding: 20px 20px 5px 20px;">
                    <form action="{{ route('store_category') }}" method="POST">
                        @csrf
                        <div class="form-group" style="width: 100%;display: flex;align-items:center;justify-content: space-between;">
                            <input type="text" name="name" placeholder="Enter category name" class="ui-input">
                            <input type="submit" value="Add">
                        </div>
                    </form>
                </div>
                <div class="list">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <div class="list-item">
                                <div class="left">
                                    {{ $category->name }}
                                </div>
                                <div class="right">
                                    {{-- <a href="{{ route('show_product',$category->id) }}"><i class="bi bi-eye"></i></a> --}}
                                    <div href="{{ route('edit_category',$category->id) }}" onclick="updateCategoryForm({id:'{{ $category->id }}',name:'{{ $category->name }}'})"><i class="bi bi-pen"></i></div>
                                    <a href="{{ route('delete_category',$category->id) }}"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="padding: 20px;">No categories stored</p>
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

    function updateCategoryForm(data) {
        console.log(data.id)
        $(".categoryForm").html(`
                <form action="/dashboard/category/update/${data.id}" method="post">
                    @csrf
                    <div class="form-group" style="width: 100%;display: flex;align-items:center;justify-content: space-between;">
                        <input type="text" name="name" value="${data.name}" class="ui-input">
                        <input type="submit" value="Edit">
                    </div>
                </form>
            `)
    }
</script>
