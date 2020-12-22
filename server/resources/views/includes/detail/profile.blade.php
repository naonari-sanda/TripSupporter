<h2>profile</h2>
<table class="table table-striped">

    <tr>
        <th>面積</th>
        <td>約{{ number_format($country->area) }}万平方キロメートル</td>
    </tr>
    <tr>
        <th>人口</th>
        <td>約{{ number_format($country->population) }}万人</td>
    </tr>
    <tr>
        <th>首都</th>
        <td>{{ $country->capital }}</td>
    </tr>
    <tr>
        <th>母国語</th>
        <td>{{ $country->language }}</td>
    </tr>
    <tr>
        <th>宗教</th>
        <td>{{ $country->religion }}</td>
    </tr>
    <tr>
        <th>GDP</th>
        <td>約{{ number_format($country->gdp) }}万ドル</td>
    </tr>
    <tr>
        <th>幸福度</th>
        <td>約{{ number_format($country->happiness) }} <a href="https://ja.wikipedia.org/wiki/%E4%B8%96%E7%95%8C%E5%B9%B8%E7%A6%8F%E5%BA%A6%E5%A0%B1%E5%91%8A">(世界幸福度報告)</a></td>
    </tr>
    <tr>
        <th>入国制限<br>（コロナ）</th>
        <td>{{ $country->covid }}</td>
    </tr>
    <tr>
        <th>詳細</th>
        <td>
            <p>{!! nl2br(e($country->detail)) !!}</p>
        </td>
    </tr>
</table>