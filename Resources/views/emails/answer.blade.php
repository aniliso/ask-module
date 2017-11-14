<div class="guestbook-mail">
    <p>{{ setting('theme::company-name') }} sayfamızda sorulan sorunuz:</p>

    <p>{{ $question->question }}</p>

    <hr style="border:1px solid #e6e6e6;" />

    <div style="padding: 10px; margin: 10px 0;">
        {!! $question->answer !!}
    </div>

    <hr style="border:1px solid #e6e6e6;" />

    <div>
        <p>{!! setting('theme::address') !!}</p>
        <div class="border-paragraphs">
            <p class="info">
                Telefon:
                <span>{!! setting('theme::phone') !!}<br/>
                    {!! setting('theme::phone2') !!}<br/>
                    {!! setting('theme::mobile') !!}
        </span>
            </p>
            <p>
                Faks:
                {!! setting('theme::fax') !!}
            </p>
            <p>
                E-mail:
                <a href="mailto:{!! HTML::email(setting('theme::email')) !!}">{!! HTML::email(setting('theme::email')) !!}</a>
            </p>
        </div>
    </div>

</div>



<style>
.guestbook-mail {
    font-family: Arial, Verdana, "Trebuchet MS", sans-serif;
    padding: 20px;
}
</style>

