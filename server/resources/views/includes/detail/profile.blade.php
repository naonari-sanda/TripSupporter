<h2>国詳細</h2>
<table class="table table-striped">

    <tr>
        <th class="bg-color">面積</th>
        <td class="bg-color">約{{ number_format($country->area) }}万平方キロメートル</td>
    </tr>
    <tr>
        <th>人口</th>
        <td>約{{ number_format($country->population) }}万人</td>
    </tr>
    <tr>
        <th class="bg-color">首都</th>
        <td class="bg-color">{{ $country->capital }}</td>
    </tr>
    <tr>
        <th>母国語</th>
        <td>{{ $country->language }}</td>
    </tr>
    <tr>
        <th class="bg-color">宗教</th>
        <td class="bg-color">{{ $country->religion }}</td>
    </tr>
    <tr>
        <th>GDP</th>
        <td>約{{ number_format($country->gdp) }}万ドル</td>
    </tr>
    <tr>
        <th class="bg-color">幸福度</th>
        <td class="bg-color">約{{ number_format($country->happiness) }} <a href="https://ja.wikipedia.org/wiki/%E4%B8%96%E7%95%8C%E5%B9%B8%E7%A6%8F%E5%BA%A6%E5%A0%B1%E5%91%8A">(世界幸福度報告)</a></td>
    </tr>
    <tr>
        <th>入国制限<br>（コロナ）</th>
        <td>{!! nl2br(e($country->covid)) !!}</td>
    </tr>
    <tr>
        <th class="bg-color">詳細</th>
        <td class="bg-color">
            <p>{!! nl2br(e($country->detail)) !!}</p>
        </td>
    </tr>
</table>