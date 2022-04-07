<urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
        xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ date('Y-m-dTH:00:00+07:00') }}</lastmod>
        <changefreq>hourly</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach($categories as $category)
        <url>
            <loc>{{ $category->getUrlBlog() }}</loc>
            <lastmod>{{ date('Y-m-dT00:00:00+07:00') }}</lastmod>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach
    @foreach(\Fsd\Tours\Tour::TYPE as $typeId => $type)
        <url>
            <loc>{{ route('tour.by.type', [$typeId, $type['slug']]) }}</loc>
            <lastmod>{{ date('Y-m-dT00:00:00+07:00') }}</lastmod>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach
    @foreach($cities as $city)
        <url>
            <loc>{{ $city->getUrl() }}</loc>
            <lastmod>{{ date('Y-m-dT00:00:00+07:00') }}</lastmod>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach
    @foreach($places as $place)
        <url>
            <loc>{{ $place->getUrl() }}</loc>
            <lastmod>{{ date('Y-m-dT00:00:00+07:00') }}</lastmod>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach
    @foreach($posts as $post)
        <url>
            <loc>{{ $post->getUrl() }}</loc>
            <lastmod>{{ date('Y-m-dT00:00:00+07:00') }}</lastmod>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach
</urlset>