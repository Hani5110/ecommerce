@extends('layouts.app')

@section('content')

<div class="product-wrapper">

    <div class="product-container">

        <div class="product-grid">

            <!-- LEFT SIDE : IMAGE GALLERY -->
            <div class="gallery-section">

                @if(!empty($product->images))

                <div class="main-image-box">
                    <img id="mainImage" src="{{ asset('storage/'.$product->images[0]) }}">
                </div>

                <div class="thumbnail-row">

                    @foreach($product->images as $image)

                    <img src="{{ asset('storage/'.$image) }}"
                         class="thumbnail"
                         onclick="changeImage(this)">

                    @endforeach

                </div>

                @endif

            </div>


            <!-- RIGHT SIDE : PRODUCT INFO -->
            <div class="info-section">

                <h1 class="product-name">{{ $product->name }}</h1>

                <div class="price-box">
                    ${{ number_format($product->price,2) }}
                </div>

                <div class="divider"></div>

                <p class="product-description">
                    {{ $product->description }}
                </p>

                <div class="button-group">

                    <a href="{{ route('products.edit',$product->id) }}" class="btn-primary">
                        Edit Product
                    </a>

                    <a href="{{ route('products.index') }}" class="btn-secondary">
                        Back to Products
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

/* Page wrapper */

.product-wrapper{
padding:40px;
}

/* Main card */

.product-container{
background:white;
border-radius:20px;
padding:40px;
box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

/* Grid Layout */

.product-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:40px;
align-items:center;
}

/* Main Image */

.main-image-box{
width:100%;
height:420px;
border-radius:18px;
overflow:hidden;
background:#f1f5f9;
display:flex;
align-items:center;
justify-content:center;
}

.main-image-box img{
width:100%;
height:100%;
object-fit:cover;
transition:0.4s;
}

.main-image-box img:hover{
transform:scale(1.05);
}

/* Thumbnails */

.thumbnail-row{
display:flex;
gap:15px;
margin-top:15px;
}

.thumbnail{
width:85px;
height:85px;
object-fit:cover;
border-radius:12px;
cursor:pointer;
border:3px solid transparent;
transition:0.25s;
}

.thumbnail:hover{
border-color:#6366f1;
transform:scale(1.1);
}

/* Info Section */

.product-name{
font-size:32px;
font-weight:700;
margin-bottom:10px;
color:#0f172a;
}

.price-box{
font-size:28px;
font-weight:700;
color:#2563eb;
margin-bottom:20px;
}

.product-description{
color:#64748b;
line-height:1.7;
font-size:15px;
margin-bottom:30px;
}

.divider{
height:1px;
background:#e2e8f0;
margin:20px 0;
}

/* Buttons */

.button-group{
display:flex;
gap:15px;
}

.btn-primary{
background:linear-gradient(135deg,#6366f1,#8b5cf6);
color:white;
padding:12px 22px;
border-radius:12px;
font-weight:600;
text-decoration:none;
}

.btn-primary:hover{
opacity:0.9;
}

.btn-secondary{
background:#e2e8f0;
padding:12px 22px;
border-radius:12px;
font-weight:600;
color:#334155;
text-decoration:none;
}

.btn-secondary:hover{
background:#cbd5f5;
}

/* Responsive */

@media(max-width:900px){

.product-grid{
grid-template-columns:1fr;
}

}

</style>


<script>

function changeImage(element){
document.getElementById("mainImage").src = element.src;
}

</script>

@endsection