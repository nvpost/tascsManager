
<h3>Проекты</h3>
<div class="card_field">
    @foreach($projects as $p)

        <div class="card card-3">
            <div class="card__icon"><i class="fas fa-bolt"></i></div>
            <p class="card__exit"><i class="fas fa-times"></i></p>
            <h2 class="card__title">
                {{$p['label']}}
            </h2>
            <p class="card__apply">
                <a class="card__link" href="#">Apply Now <i class="fas fa-arrow-right"></i></a>
            </p>
        </div>

    @endforeach

</div>

<style>
    .card_field {
        display: flex;
        flex-wrap: wrap;
        /*justify-content: space-between;*/
        width: 100%;

    }

    .card {
        margin: 20px;
        padding: 20px;
        width: 28%;
        min-height: 200px;
        /*display: grid;*/
        /*grid-template-rows: 20px 50px 1fr 50px;*/
        border-radius: 10px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
        transition: all 0.2s;
    }

    .card:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
        transform: scale(1.01);
    }

    .card-3 {
        background: radial-gradient(#76b2fe, #b69efe);
    }

</style>
