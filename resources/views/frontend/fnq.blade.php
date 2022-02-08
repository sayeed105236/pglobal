@extends('frontend.master.master')
@section('body')


<style type="text/css">
	.accordion_w {
	    width: 80%;
	    padding: 30px 0px;
	    margin: 48px 10%;
	    border: 1px solid #eeee;
	    box-sizing: border-box;
	    background-color: #fff;
	}
	.accordion {
		cursor: pointer;
	    width: 100%;
	    text-align: left;
	    font-size: 15px;
	    margin-top: 7px;
	    border: 1px solid transparent;
	    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
	    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
	    border-color: #ddd;
	    display: flex;
	    position: relative;
	    align-items: center;
	    color: inherit;
	    padding: 1.4rem 5rem 1.4rem 2rem;
	    transition: background-color 0.4s;
	    padding-top: 1.5rem;
	    background-color: 
	}
	.active, .accordion:hover {
	      background-color: #f5f0f0c2;
	}
	.panel {
	    display: none;
	    background-color: white;
	    overflow: hidden;
	    padding: 15px;
	    background-color: #ffffff!important;
	    border: 1px solid #eeeeee;
	}
	</style>

<div class="container"  style="margin-top:50px;margin-bottom:50px;">
    <div class="row accordion_w">
        <h3 class="col-md-12 col-12 text-center">
            আপনার জিজ্ঞাসা, আমাদের উত্তর
        </h3>

        @php
            $fnq=App\admin\raw_tbl::where("type","fnq")->where("section","page")->get()
        @endphp
        <div class="col-md-12 col-12 accordion_w2">

            @foreach($fnq as $fnq)
            <button class="accordion">{{$fnq->title}}</button>
            <div class="panel">
                {{$fnq->description}}
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
	    this.classList.toggle("active");
	    var panel = this.nextElementSibling;
	    if (panel.style.display === "block") {
	      panel.style.display = "none";
	    } else {
	      panel.style.display = "block";
	    }
	  });
	}
</script>
@endsection
