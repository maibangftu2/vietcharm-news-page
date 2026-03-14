<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * TinTucController
 * 
 * Controller cho trang Tin Tức.
 * 
 * Route cần thêm vào `routes/web.php`:
 *   Route::get('/tin-tuc', [TinTucController::class, 'index'])->name('tin-tuc.index');
 */
class TinTucController extends Controller
{
    /**
     * Hiển thị trang danh sách tin tức.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy bài viết, sắp xếp theo ngày mới nhất
        // Tuỳ vào cách lưu dữ liệu, có thể dùng Eloquent Model hoặc hardcode
        $newsItems = $this->getNewsItems();

        return view('tin-tuc.index', compact('newsItems'));
    }

    /**
     * Lấy danh sách bài viết tin tức.
     * 
     * OPTION 1: Nếu dùng database (Eloquent Model)
     * --------------------------------------------------
     * return \App\Models\News::orderBy('published_at', 'desc')->get();
     * 
     * OPTION 2: Hardcode dữ liệu (không cần database)
     * --------------------------------------------------
     * Dùng cách này nếu chỉ cần hiển thị static content.
     * 
     * @return \Illuminate\Support\Collection
     */
    private function getNewsItems()
    {
        $items = [
            [
                'title'        => 'Hành Trình Trải Nghiệm Văn Hoá Đa Giác Quan',
                'source'       => 'HERITAGE',
                'excerpt'      => 'Trong khuôn viên Dinh Độc Lập, VietCharm Culture & Dining Show lựa chọn cách tiếp cận "xem, nếm và cảm" trong một hành trình liền mạch 90 phút.',
                'published_at' => '2026-03-04',
                'image'        => 'images/news/heritage-article.jpg',
                'url'          => 'https://heritagevietnamairlines.com/cac-an-pham/heritage/h284-mar-2026/',
                'tags'         => ['Văn hóa', 'Ẩm thực'],
            ],
            [
                'title'        => 'VietCharm Culture & Dining Show đầu tiên trong khuôn viên Dinh Độc Lập',
                'source'       => 'VTV.vn',
                'excerpt'      => 'VTV.vn - VietCharm lần đầu tiên mang đến trải nghiệm văn hóa, ẩm thực cao cấp VietCharm Culture & Dining Show trong khuôn viên Dinh Độc Lập, ra mắt dịp Tết Nguyên đán 2026.',
                'published_at' => '2026-03-04',
                'image'        => 'images/news/vtv-article.jpg',
                'url'          => 'https://vtv.vn/vietcharm-culture-dining-show-dau-tien-trong-khuon-vien-dinh-doc-lap-100260214235232929.htm',
                'tags'         => ['Truyền hình', 'Sự kiện'],
            ],
            [
                'title'        => 'Show ẩm thực gần 2 triệu đồng ở Dinh Độc Lập đặc biệt mức nào?',
                'source'       => 'Thanhnien.vn',
                'excerpt'      => 'Lần đầu tiên, một show diễn đa giác quan VietCharm được tổ chức ngay trong không gian Dinh Độc Lập. Với giá vé gần 2 triệu đồng, khán giả không chỉ xem, mà còn có thể chạm, cảm nhận và trực tiếp tham gia vào không gian trình diễn văn hóa Việt.',
                'published_at' => '2026-03-04',
                'image'        => 'images/news/thanhnien-article.jpg',
                'url'          => 'https://thanhnien.vn/show-am-thuc-gan-2-trieu-dong-o-dinh-doc-lap-dac-biet-muc-nao-185260209222601845.htm',
                'tags'         => ['Ẩm thực', 'Đánh giá'],
            ],
            [
                'title'        => 'VietCharm Show – Khi di sản được kể lại bằng nghệ thuật, ẩm thực và cảm xúc',
                'source'       => 'Tuoitre.vn',
                'excerpt'      => 'Dinh Độc Lập không còn là điểm tham quan tĩnh, mà trở thành nơi diễn ra một hành trình trải nghiệm đa giác quan - nơi di sản, nghệ thuật trình diễn và ẩm thực Việt Nam cùng hòa quyện trong dòng chảy đương đại.',
                'published_at' => '2026-02-17',
                'image'        => 'images/news/tuoitre-article.jpg',
                'url'          => 'https://tuoitre.vn/vietcharm-show-khi-di-san-duoc-ke-lai-bang-nghe-thuat-am-thuc-va-cam-xuc-20260210104347736.htm',
                'tags'         => ['Nghệ thuật', 'Di sản'],
            ],
            [
                'title'        => 'Show văn hóa - ẩm thực trong Dinh Độc Lập dịp Tết của VietCharm',
                'source'       => 'Vnexpress.net',
                'excerpt'      => 'VietCharm Culture & Dining Show ra mắt tại Dinh Độc Lập vào mùng 1 Tết Bính Ngọ, kết hợp nghệ thuật biểu diễn đương đại và ẩm thực trong không gian di tích lịch sử.',
                'published_at' => '2026-02-14',
                'image'        => 'images/news/vnexpress-article.jpg',
                'url'          => 'https://vnexpress.net/show-van-hoa-am-thuc-trong-dinh-doc-lap-dip-tet-cua-vietcharm-5039397.html',
                'tags'         => ['Tết', 'Ẩm thực'],
            ],
            [
                'title'        => 'Tết Bính Ngọ: VietCharm Culture & Dining Show đầu tiên trong Dinh Độc Lập',
                'source'       => 'Vietnamnet.vn',
                'excerpt'      => 'VietCharm Culture & Dining Show sẽ chính thức ra mắt công chúng tối ngày 17/02/2026, mang đến hành trình trải nghiệm văn hoá đa sắc.',
                'published_at' => '2026-02-01',
                'image'        => 'images/news/vietnamnet-article.jpg',
                'url'          => 'https://vietnamnet.vn/tet-binh-ngo-vietcharm-culture-dining-show-dau-tien-trong-dinh-doc-lap-2489425.html',
                'tags'         => ['Sự kiện', 'Văn hóa'],
            ],
            [
                'title'        => 'VietCharm Culture & Dining Show nhận được sự đón nhận đông đảo của khán giả Việt',
                'source'       => 'Yan.vn',
                'excerpt'      => 'VietCharm Culture & Dining Show nhận được sự đón nhận đông đảo của khán giả Việt từ những ngày đầu công diễn.',
                'published_at' => '2026-02-01',
                'image'        => 'images/news/yan-article.jpg',
                'url'          => 'https://www.yan.vn/vietcharm-khi-di-san-duoc-dan-bang-tinh-yeu-van-hoa-viet-nam-333597.html',
                'tags'         => ['Truyền thông', 'Sự kiện'],
            ],
            [
                'title'        => 'Vietcharm - Khi di sản được "đan" bằng tình yêu văn hoá Việt Nam',
                'source'       => '24h.com.vn',
                'excerpt'      => 'Vietcharm - Khi di sản được "đan" bằng tình yêu văn hoá Việt Nam. Show diễn nghệ thuật kết hợp ẩm thực tại Dinh Độc Lập.',
                'published_at' => '2026-02-01',
                'image'        => 'images/news/24h-article.jpg',
                'url'          => 'https://www.24h.com.vn/the-gioi-giai-tri/vietcharm-khi-di-san-duoc-dan-bang-tinh-yeu-van-hoa-viet-nam-c680a1740647.html',
                'tags'         => ['Di sản', 'Văn hóa'],
            ],
            [
                'title'        => 'Vietcharm - Khi di sản được "đan" bằng tình yêu văn hoá Việt Nam',
                'source'       => 'Kenh14.vn',
                'excerpt'      => 'Vietcharm - Khi di sản được "đan" bằng tình yêu văn hoá Việt Nam. Show diễn đa giác quan tại Dinh Độc Lập.',
                'published_at' => '2026-02-01',
                'image'        => 'images/news/kenh14-article.jpg',
                'url'          => 'https://kenh14.vn/vietcharm-khi-di-san-duoc-dan-bang-tinh-yeu-van-hoa-viet-nam-215260302134524526.chn',
                'tags'         => ['Giải trí', 'Văn hóa'],
            ],
        ];

        // Chuyển thành Collection với Carbon dates
        return collect($items)->map(function ($item) {
            $item['published_at'] = \Carbon\Carbon::parse($item['published_at']);
            return (object) $item;
        })->sortByDesc('published_at');
    }
}
