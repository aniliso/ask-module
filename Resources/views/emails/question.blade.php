<div class="guestbook-mail">
    <p>{{ setting('theme::company-name') }} sayfanızda bir soru soruldu.</p>


    <table border="0" cellpadding="5" cellspacing="5">
        <tbody>
        <tr>
            <th style="width: 250px;">Adı</th>
            <td>{{ $question->fullname }}</td>
        </tr>
        <tr>
            <th>Telefon</th>
            <td>{{ $question->phone }}</td>
        </tr>
        <tr>
            <th>E-Posta</th>
            <td>{{ $question->email }}</td>
        </tr>
        <tr>
            <th>Soru</th>
            <td>{{ $question->question }}</td>
        </tr>
        </tbody>
    </table>

</div>

<style>
.guestbook-mail {
    font-family: Arial, Verdana, "Trebuchet MS", sans-serif;
    padding: 20px;
}
</style>

