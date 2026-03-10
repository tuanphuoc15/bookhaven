-- Auto-generated real metadata seed
-- Rows: 60

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Đắc Nhân Tâm', 'Dale Carnegie', 170000, 'Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ. Trong suốt nhiều thập kỷ tiếp theo và cho đến tận bây giờ, tác phẩm này vẫn chiếm vị trí số một trong danh mục sách bán chạy nhất và trở thành một sự kiện có một không hai trong lịch sử ngành xuất bản thế giới và được đánh giá là một quyển sách có tầm ảnh hưởng nhất mọi thời đại. Đây là cuốn sách độc nhất về thể loại self...', 'real_001.jpg', 1, 2018, 'Tiếng Việt', 320, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Đắc Nhân Tâm' AND author = 'Dale Carnegie');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Nhà giả kim', 'Paulo Coelho', 135000, 'Tiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, ...', 'book1.jpg', 1, 2023, 'Tiếng Việt', 180, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Nhà giả kim' AND author = 'Paulo Coelho');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Muôn Kiếp Nhân Sinh 2', 'Nguyên Phong', 229000, 'Hiếm có cuốn sách nào ngay từ khi ra mắt đã tạo nên hiện tượng văn hóa đọc và sau nửa năm đã trở thành cuốn sách bán chạy nhất năm 2020 tại Việt Nam như Muôn Kiếp Nhân Sinh. Cơn sốt của cuốn sách này tiếp tục được dấy lên vào dịp Tết Nguyên Đán 2021 khi công ty First News Trí Việt hé lộ đang “ngày đêm thực hiện Muôn Kiếp Nhân Sinh tập 2”. Đáp lại sự mong đợi của độc giả suốt hơn ba tháng, Muôn Kiếp Nhân Sinh tập 2 đã chính thức phát hành trên ...', 'real_003.jpg', 1, 2018, 'Tiếng Việt', 557, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Muôn Kiếp Nhân Sinh 2' AND author = 'Nguyên Phong');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Tuổi trẻ đáng giá bao nhiêu?', 'Rosie Nguyễn', 161000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 2017, 'Tiếng Việt', 285, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Tuổi trẻ đáng giá bao nhiêu?' AND author = 'Rosie Nguyễn');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Thư mục quốc gia Việt Nam', 'Unknown', 289000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'real_005.jpg', 1, 2016, 'Tiếng Việt', 1184, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Thư mục quốc gia Việt Nam' AND author = 'Unknown');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Cà phê cùng Tony', 'Tony Buổi Sáng', 154000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 2014, 'Tiếng Việt', 255, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Cà phê cùng Tony' AND author = 'Tony Buổi Sáng');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Tôi tài giỏi, bạn cũng thế', 'Adam Khoo', 135000, '"Thật không biết phải làm sao với con trai chúng tôi. Nó được gởi đi học thêm khắp nơi mà vẫn làm bài thi tệ hại. Chúng tôi tự hỏi sau này nó có làm nên trò trống gì không nữa". Đó chính là những gì mà cha mẹ của Adam Khoo đã từng than vãn về sự kém cõi và kết quả thi cử thảm hại của cậu bé Adam nhiều năm về trước. May mắn thay, vào thời điểm tăm tối nhất trong đời, Adam đã tìm thấy và học tập theo công thức thành công của những người tài giỏi...', 'book1.jpg', 1, 2020, 'Tiếng Việt', 180, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Tôi tài giỏi, bạn cũng thế' AND author = 'Adam Khoo');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Hạt Giống Tâm Hồn 5', 'First News', 126000, 'Khi đến với cuộc sống này, bất kỳ ai trong chúng ta cũng mong muốn lớn lên có được một tương lai tươi đẹp. Chúng ta ấp ủ trong lòng nhiều hoài bão, ước mơ chinh phục, khám phá bao điều mới lạ trên thế giới. Chúng ta tin tưởng bản thân có thể vươn lên tự khẳng định mình. Thế nhưng thực tế là hành trình cuộc sống không phải lúc nào cũng diễn ra trên con đường bằng phẳng và sáng sủa. Sẽ có những lúc bạn không thể tránh khỏi những thử thách, cạm b...', 'real_008.jpg', 1, 2018, 'Tiếng Việt', 144, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Hạt Giống Tâm Hồn 5' AND author = 'First News');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Đi Tìm Lẽ Sống', 'Viktor Emil Frankl', 146000, 'Thông thường, nếu một quyển sách chỉ có một đoạn văn, một ý tưởng có sức mạnh thay đổi cuộc sống của một người, thì chỉ riêng điều đó cũng đã đủ để chúng ta đọc đi đọc lại và dành cho nó một chỗ trên kệ sách của mình. Quyển sách này có nhiều đoạn văn như thế. Trước hết, đây là quyển sách viết về sự sinh tồn. Giống như nhiều người Do Thái sinh sống tại Đức và Đông Âu khi ấy, vốn nghĩ rằng mình sẽ được an toàn trong những năm 1930, Frankl đã trả...', 'real_009.jpg', 1, 2018, 'Tiếng Việt', 224, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Đi Tìm Lẽ Sống' AND author = 'Viktor Emil Frankl');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Sapiens [Tenth Anniversary Edition]', 'Yuval Noah Harari', 239000, 'New York Times Readers’ Pick: Top 100 Books of the 21st Century The tenth anniversary edition of the internationally bestselling phenomenon that cemented Yuval Noah Harari as one of the most prominent historians of our time—featuring a new afterword from the author. One hundred thousand years ago, at least six human species inhabited the earth. Today there is just one. Us. Homo sapiens. How did our species succeed in the battle for dominance? ...', 'real_010.jpg', 1, 2025, 'English', 594, 'HarperCollins'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Sapiens [Tenth Anniversary Edition]' AND author = 'Yuval Noah Harari');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Homo Deus A Brief History of Tomorrow', 'Yuval Noah Harari', 223000, 'Step into the future with Yuval Noah Harari’s groundbreaking book, Homo Deus: A Brief History of Tomorrow. Discover how humanity’s next chapter may be defined by the pursuit of immortality, artificial intelligence, and ultimate happiness, as we attempt to transcend our biological limitations. Harari challenges everything we know about the future of humankind, revealing the possibility that we might soon become gods ourselves. As technology adv...', 'real_011.jpg', 1, 2024, 'English', 531, 'Prabhat Prakashan'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Homo Deus A Brief History of Tomorrow' AND author = 'Yuval Noah Harari');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'HAWKING HAWKING', 'Charles Seife', 241000, '“HAWKING HAWKING – Câu chuyện về một huyền thoại khoa học” được đánh giá là một trong mười cuốn tiểu sử hay nhất năm 2021 do Prospect Magazine bình chọn. Hawking là biểu tượng cuối cùng cho sự chiến thắng của trí óc. Hawking là người đàn ông thông minh nhất thế giới, một bộ óc vô song. Hawking đã trở thành nhà khoa học còn sống nổi tiếng nhất thế giới vào khoảng một phần ba cuối đời mình. Nhưng: Sự nổi tiếng đó ít nhiều lại không liên quan đến...', 'real_012.jpg', 1, 2024, 'Tiếng Việt', 604, 'Vietnam Omega Books. JSC'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'HAWKING HAWKING' AND author = 'Charles Seife');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Vũ trụ trong vỏ hạt dẻ', 'Stephen Hawking', 153000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 6, 2007, 'Tiếng Việt', 251, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Vũ trụ trong vỏ hạt dẻ' AND author = 'Stephen Hawking');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT '7 Thói Quen Của Bạn Trẻ Thành Đạt', 'Sean Covey', 174000, '7 Thói Quen Của Bạn Trẻ Thành Đạt nhấn mạnh những gì chúng ta có được trong cuộc sống đều bắt nguồn từ những thói quen của chính mình. Ai cũng có những thói quen tốt và những thói quen xấu, và mỗi chúng ta phải rèn luyện những thói quen tốt và biết điều chỉnh, loại bỏ những thói quen xấu. Tuổi thiếu niên và trưởng thành là tuổi đẹp nhất và quan trọng nhất của đời người. Đây cũng là lứa tuổi mà các bạn trẻ bắt đầu khám phá cuộc sống với những ư...', 'real_014.jpg', 1, 2018, 'Tiếng Việt', 336, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = '7 Thói Quen Của Bạn Trẻ Thành Đạt' AND author = 'Sean Covey');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Think and Grow Rich: 16 Nguyên tắc nghĩ giàu làm giàu trong thế kỉ 21 - Napoleon Hill', 'Napoleon Hill', 197000, 'Cuốn sách nay đã được Bizbooks mua bản quyền. Trong ấn bản cập nhật này Bizbooks sẽ giúp độc giả khai thác từng khía cạnh của Think and Grow Rich đều được phân tích để đảm bảo phù hợp với môi trường kinh doanh hiện tại trong thế kỷ 21, tiến bộ khoa học ngày nay. Hơn thế nữa, ấn bản lần này còn hoàn thiện những gì mà Napoleon Hill chưa phân tích và chưa đề cập tới. Nhìn lại những thành tựu của Think and Grow Rich Think and Grow Rich - Nghĩ giàu...', 'real_015.jpg', 1, 2018, 'Tiếng Việt', 428, 'Bizbooks'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Think and Grow Rich: 16 Nguyên tắc nghĩ giàu làm giàu trong thế kỉ 21 - Napoleon Hill' AND author = 'Napoleon Hill');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Quẳng Gánh Lo Đi Và Vui Sống', 'Dale Carnegie', 168000, 'Quẳng Gánh Lo Đi Và Vui Sống là cuốn sách mà cái tên đã nói lên tất cả nội dung chuyển tải trên những trang giấy. Bất kỳ ai đang sống đều sẽ có những lo lắng thường trực về học hành, công việc, những hoá đơn, chuyện nhà cửa,... Cuộc sống không dễ dàng giải thoát bạn khỏi căng thẳng, ngược lại, nếu quá lo lắng, bạn có thể mắc bệnh trầm cảm. Quẳng Gánh Lo Đi Và Vui Sống khuyên bạn hãy khóa chặt dĩ vãng và tương lai lại để sống trong cái phòng kí...', 'real_016.jpg', 1, 2018, 'Tiếng Việt', 312, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Quẳng Gánh Lo Đi Và Vui Sống' AND author = 'Dale Carnegie');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Sức Mạnh Của Thói Quen', 'Charles Duhigg', 145000, 'Sức Mạnh Của Thói Quen - The Power Of Habit Về cơ bản, người lớn và trẻ em không khác nhau là mấy. Bởi hầu hết những hành động hàng ngày của chúng ta đều là sản phẩm của thói quen vô thức. Thế nhưng không phải cá nhân, tổ chức nào cũng có được thành công. Đó là vì mỗi người có những thói quen riêng. Vậy thói quen nào mới giúp bạn thành công? Trong cuốn sách “Sức mạnh của thói quen”, Charles Duhigg sẽ giải đáp thắc mắc ấy. Chìa khoá quan trọng ...', 'real_017.jpg', 1, 2018, 'Tiếng Việt', 219, 'Alpha Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Sức Mạnh Của Thói Quen' AND author = 'Charles Duhigg');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Tư Duy Nhanh Và Chậm', 'Daniel Kahneman', 243000, 'Tư Duy Nhanh Và Chậm được tạp chí New York Times bình chọn là sách hay nhất năm 2011. Chúng ta thường tự cho rằng con người là sinh vật có lý trí mạnh mẽ, khi quyết định hay đánh giá vấn đề luôn kỹ lưỡng và lý tính. Nhưng sự thật là, dù bạn có cẩn trọng tới mức nào, thì trong cuộc sống hàng ngày hay trong vấn đề liên quan đến kinh tế, bạn vẫn có những quyết định dựa trên cảm tính chủ quan của mình. Trong sách nói Tư Duy Nhanh Và Chậm, cuốn sác...', 'real_018.jpg', 1, 2018, 'Tiếng Việt', 612, 'Alpha Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Tư Duy Nhanh Và Chậm' AND author = 'Daniel Kahneman');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'TƯ DUY KHỞI NGHIỆP', 'Vivian Vu', 115000, '“Tư Duy Khởi Nghiệp – Nhạy Bén với Cơ Hội, Chấp Nhận Rủi Ro, Hành Động Nhanh” là cuốn sách dành cho bất kỳ ai muốn làm chủ cuộc đời mình — dù bạn đang là nhân viên văn phòng, quản lý hay đang ấp ủ một ý tưởng kinh doanh. Trong thời đại thay đổi từng ngày, tư duy khởi nghiệp (entrepreneurial thinking) không chỉ dành cho doanh nhân, mà là kỹ năng sinh tồn của người hiện đại: biết nhìn thấy cơ hội trong khó khăn, dám hành động, và luôn học hỏi để...', 'real_019.jpg', 5, 2025, 'Tiếng Việt', 100, 'Vivian Vu'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'TƯ DUY KHỞI NGHIỆP' AND author = 'Vivian Vu');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Làm ra làm chơi ra chơi', 'Carl Newport', 179000, 'Làm Ra Làm Chơi Ra Chơi Đã bao giờ bạn ngồi xuống để làm việc và sau đó, không hề nhận ra mình lại kết thúc bằng việc dành một (vài) tiếng đồng hồ lướt Youtube, Facebook, tin tức? Tất cả chúng ta đều đã từng làm vậy. Có vẻ như có quá nhiều thứ lôi kéo sự chú ý của chúng ta trong thời đại này, nên rất khó để thậm chí đạt đến trạng thái tinh thần giúp hoàn thành công việc một cách tốt nhất. Trong Làm ra làm chơi ra chơi, tác giả Cal Newport nhấn...', 'real_020.jpg', 1, 2018, 'Tiếng Việt', 356, 'Alpha Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Làm ra làm chơi ra chơi' AND author = 'Carl Newport');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Nghệ thuật tinh tế của việc đếch quan tâm', 'Mark Manson', 176000, 'Mark Monson, một blogger, tác giả trẻ nổi tiếng trên mạng đã chia sẻ những góc nhìn rất độc đáo về cuộc sống cũng như nghệ thuật mặc kệ mọi thứ. Những bài học của Mark Manson về cuộc sống được nhiều người khen ngợi và học tập. Trong cuốn sách mới của anh với tựa "Nghệ thuật tinh tế của việc không quan tâm" anh đã có những góc nhìn hết sức độc đáo. Dưới đây là đoạn trích trong blog của anh về vấn đề này. "Trong cuộc sống của tôi, tôi đã từng rấ...', 'real_021.jpg', 1, 2018, 'Tiếng Việt', 344, 'StreetLib'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Nghệ thuật tinh tế của việc đếch quan tâm' AND author = 'Mark Manson');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Ikigai - Đi Tìm Lý Do Thức Dậy Mỗi Sáng', 'Hector Garcia', 130000, 'Ý nghĩa cuộc đời mình là gì? Phải chăng mục đích chỉ là để sống lâu hơn, hay nên tìm kiếm một mục đích lớn lao? Tại sao có những người biết rõ điều họ muốn và sống trọn đam mê cả cuộc đời, trong khi số khác lại héo mòn trong lú lẫn? Trong cuộc trò chuyện của chúng tôi, từ bí ẩn ikigai được nhắc đến. Trong tiếng Nhật, Ikigai có nghĩa là “đi tìm mục đích sống của đời bạn” hoặc là “một lý do để thức dậy mỗi sáng”. Người Nhật quan niệm rằng mỗi ng...', 'real_022.jpg', 1, 2018, 'Tiếng Việt', 159, 'NXB Công Thương'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Ikigai - Đi Tìm Lý Do Thức Dậy Mỗi Sáng' AND author = 'Hector Garcia');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Doanh nghiệp tinh gọn 2', 'Trevor Owens & Obie Fernandez', 169000, 'Với Bộ Doanh nghiệp Tinh gọn, bạn có thể nắm bắt được cách thức vận dụng triết lý Tinh gọn trên bình diện toàn bộ doanh nghiệp để cải tiến, đổi mới hoạt động sản xuất kinh doanh của doanh nghiệp từ quản trị chiến lược, quản trị tài chính, quản trị hoạt động tác nghiệp, quản lý danh mục đầu tư, đến quản lý rủi ro, tái cấu trúc bộ máy, hệ thống kinh doanh. Các tác giả đã cố gắng xây dựng một bộ khuôn mẫu và những nguyên tắc theo triết lý loại bỏ...', 'real_023.jpg', 1, 2018, 'Tiếng Việt', 316, 'Alpha Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Doanh nghiệp tinh gọn 2' AND author = 'Trevor Owens & Obie Fernandez');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Từ Tốt Đến Vĩ Đại', 'Jim Collins', 178000, 'Jim Collins cùng nhóm nghiên cứu đã miệt mài nghiên cứu những công ty có bước nhảy vọt và bền vững để rút ra những kết luận sát sườn, những yếu tố cần kíp để đưa công ty từ tốt đến vĩ đại. Đó là những yếu tố khả năng lãnh đạo, con người, văn hóa, kỷ luật, công nghệ... Những yếu tố này được nhóm nghiên cứu xem xét tỉ mỉ và kiểm chứng cụ thể qua 11 công ty nhảy vọt lên vĩ đại. Mỗi kết luận của nhóm nghiên cứu đều hữu ích, vượt thời gian, ý nghĩa...', 'real_024.jpg', 1, 2018, 'Tiếng Việt', 353, 'NXB Trẻ'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Từ Tốt Đến Vĩ Đại' AND author = 'Jim Collins');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Dám bị ghét', 'Kishimi Ichiro', 135000, 'Nội dung cuốn sách trình bày một cách sinh động và hấp dẫn những nét chính trong tư tưởng của nhà tâm lý học Alfred Adler, người được mệnh danh là một trong ba người khổng lồ của tâm lý học hiện đại.', 'book1.jpg', 1, 2022, 'Tiếng Việt', 180, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Dám bị ghét' AND author = 'Kishimi Ichiro');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Điềm tĩnh và nóng giận', 'Quốc Kế Tạ', 135000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 2023, 'Tiếng Việt', 180, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Điềm tĩnh và nóng giận' AND author = 'Quốc Kế Tạ');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Càng kỷ luật, càng tự do', 'Ca Tây', 135000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 2023, 'Tiếng Việt', 180, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Càng kỷ luật, càng tự do' AND author = 'Ca Tây');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Hành Trình Về Phương Đông', 'Baird T. Spalding', 154000, 'Hành trình về phương Đông kể về những trải nghiệm của một đoàn khoa học gồm các chuyên gia hàng đầu của Hội Khoa Học Hoàng Gia Anh được cử sang Ấn Độ nghiên cứu về huyền học và những khả năng siêu nhiên của con người. Suốt hai năm trời rong ruổi khắp các đền chùa Ấn Độ, chúng kiến nhiều pháp luật, nhiều cảnh mê tín dị đoan, thậm chí lừa đảo...của nhiều pháp sư, đạo sĩ...họ được tiếp xúc với những vị thế, họ được chứng kiến, trải nghiệm, hiểu b...', 'real_028.jpg', 1, 2019, 'Tiếng Việt', 256, 'First News'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Hành Trình Về Phương Đông' AND author = 'Baird T. Spalding');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Đừng lựa chọn an nhàn khi còn trẻ', 'Cảnh Thiên', 169000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 2019, 'Tiếng Việt', 316, 'Unknown Publisher'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Đừng lựa chọn an nhàn khi còn trẻ' AND author = 'Cảnh Thiên');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Một Đời Như Kẻ Tìm Đường', 'Phan Văn Trường', 178000, 'Hai cuốn sách trước của Giáo sư Phan Văn Trường, Một đời thương thuyết và Một đời quản trị, là sự chắt lọc từ những trải nghiệm trong suốt nhiều năm tháng nghề nghiệp của bản thân. Tuy nhiên, đến với cuốn sách này, tác giả lại muốn dành một khoảng không gian riêng để có thể phản ảnh những cảm nhận cá nhân về cuộc sống, với góc nhìn từ những năm tháng tuổi trẻ cho đến độ tuổi xế chiều này. Khoảnh khắc khó chịu nhất có lẽ là khi mình đã lỡ chọn ...', 'real_030.jpg', 1, 2018, 'Tiếng Việt', 351, 'NXB Trẻ'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Một Đời Như Kẻ Tìm Đường' AND author = 'Phan Văn Trường');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Thinking, Fast and Slow', 'Daniel Kahneman', 198000, 'One of the most influential books of the 21st century: the ground-breaking psychology classic - over 10 million copies sold - that changed the way we think about thinking ''There have been many good books on human rationality and irrationality, but only one masterpiece. That masterpiece is Thinking, Fast and Slow'' Financial Times ''A lifetime''s worth of wisdom'' Steven D. Levitt, co-author of Freakonomics Why do we make the decisions we do? Nobel...', 'real_031.jpg', 1, 2011, 'English', 432, 'Penguin UK'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Thinking, Fast and Slow' AND author = 'Daniel Kahneman');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Man''s Search for Meaning: Young Adult Edition', 'Viktor E. Frankl', 137000, 'A young adult edition of the best-selling classic about the Holocaust and finding meaning in suffering, with a photo insert, a glossary of terms, a chronology of Frankl’s life, and supplementary letters and speeches Viktor E. Frankl’s Man’s Search for Meaning is a classic work of Holocaust literature that has riveted generations of readers. Like Anne Frank’s Diary of a Young Girl and Elie Wiesel’s Night, Frankl’s masterpiece is a timeless exam...', 'real_032.jpg', 1, 2017, 'English', 186, 'Beacon Press'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Man''s Search for Meaning: Young Adult Edition' AND author = 'Viktor E. Frankl');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Psychology of Money', 'Morgan Housel', 142000, 'The Sunday Times Number One Bestseller. Over 10 million copies sold around the world. The original book from Morgan Housel, the New York Times and Sunday Times bestselling author of Same As Ever and The Art of Spending Money. As featured on the Dr Chatterjee podcast Feel Better, Live More and the Diary of a CEO podcast with Steven Bartlett. Doing well with money isn''t necessarily about what you know. It''s about how you behave. And behavior is ...', 'real_033.jpg', 2, 2020, 'English', 209, 'Harriman House Limited'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Psychology of Money' AND author = 'Morgan Housel');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Midnight Library', 'Matt Haig', 169000, 'Between life and death there is a library. When Nora Seed finds herself in the Midnight Library, she has a chance to make things right. Up until now, her life has been full of misery and regret. She feels she has let everyone down, including herself. But things are about to change. The books in the Midnight Library enable Nora to live as if she had done things differently. With the help of an old friend, she can now undo every one of her regre...', 'real_034.jpg', 1, 2020, 'English', 316, 'HarperCollins'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Midnight Library' AND author = 'Matt Haig');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Norwegian Wood', 'Haruki Murakami', 187000, 'Toru Watanabe is looking back on the love and passions of his life and trying to make sense of it all. As his first love, Naoko, sinks deeper and deeper into mental despair, he is inexorably pushed to find new meanings and new love to survive.', 'real_035.jpg', 1, 2001, 'English', 389, 'Harvill Press'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Norwegian Wood' AND author = 'Haruki Murakami');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT '1984', 'George Orwell', 135000, 'Probably the most influential novel of the twentieth century, 1984 has been described as chilling, absorbing, satirical, momentous, prophetic and terrifying. This edition, with an introduction by novelist Robert Harris, marks the sixtieth anniversary of this great work’s publication.', 'real_036.jpg', 1, 2021, 'English', 180, 'National Geographic Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = '1984' AND author = 'George Orwell');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Animal Farm', 'George Orwell', 120000, 'This is a classic tale of humanity awash in totalitarianism. A farm is taken over by its overworked, mistreated animals. With flaming idealism and stirring slogans, they set out to create a paradise of progress, justice, and equality. First published during the epoch of Stalinist Russia, today it is clear that wherever and whenever freedom is attacked, and under whatever banner, the cutting clarity and savage comedy of Orwell''s masterpiece is ...', 'real_037.jpg', 1, 2009, 'English', 118, 'Transaction Publishers'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Animal Farm' AND author = 'George Orwell');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Brave New World', 'Aldous Leonard Huxley', 151000, 'In ''Brave New World'', Aldous Huxley constructs a dystopian future where society thrives on technological advancement, consumerism, and societal conditioning. The novel employs a satirical yet cautionary tone, interweaving lyrical prose with incisive social commentary. Huxley explores themes such as individuality versus conformity, the loss of personal freedom, and the ethical implications of scientific progress. Set in a World State that prior...', 'real_038.jpg', 1, 2022, 'English', 242, 'DigiCat'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Brave New World' AND author = 'Aldous Leonard Huxley');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Fahrenheit 451', 'Ray Bradbury', 144000, 'Set in the future when "firemen" burn books forbidden by the totalitarian "brave new world" regime.', 'real_039.jpg', 1, 2003, 'English', 217, 'Simon and Schuster'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Fahrenheit 451' AND author = 'Ray Bradbury');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Kite Runner', 'Khaled Hosseini', 182000, 'THE NUMBER ONE BESTSELLER ''Devastating'' Daily Telegraph ''Heartbreaking'' The Times ''Unforgettable'' Isabel Allende ''Haunting'' Independent Afghanistan, 1975: Twelve-year-old Amir is desperate to win the local kite-fighting tournament and his loyal friend Hassan promises to help him. But neither of the boys can foresee what will happen to Hassan that afternoon, an event that is to shatter their lives. After the Russians invade and the family is fo...', 'real_040.jpg', 1, 2020, 'English', 369, 'Bloomsbury Publishing'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Kite Runner' AND author = 'Khaled Hosseini');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'A Thousand Splendid Suns', 'Khaled Hosseini', 163000, 'A riveting and powerful story of an unforgiving time, an unlikely friendship and an indestructible love', 'real_041.jpg', 1, 2009, 'English', 293, 'Bloomsbury Publishing'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'A Thousand Splendid Suns' AND author = 'Khaled Hosseini');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'To Kill a Mockingbird', 'Harper Lee', 115000, 'Harper Lee''s classic novel of a lawyer in the Deep South defending a black man charged with the rape of a white girl. One of the best-loved stories of all time, To Kill a Mockingbird has earned many distinctions since its original publication in 1960. It won the Pulitzer Prize, has been translated into more than forty languages, sold more than thirty million copies worldwide, and been made into an enormously popular movie. Most recently, libra...', 'real_042.jpg', 1, 1970, 'English', 100, 'Dramatic Publishing'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'To Kill a Mockingbird' AND author = 'Harper Lee');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Book Thief', 'Markus Zusak', 235000, '#1 NEW YORK TIMES BESTSELLER • ONE OF TIME MAGAZINE’S 100 BEST YA BOOKS OF ALL TIME • A NEW YORK TIMES READER TOP 100 PICK FOR BEST BOOKS OF THE 21ST CENTURY • A KIRKUS REVIEWS BEST YOUNG ADULT BOOK OF THE CENTURY The extraordinary, beloved novel about the ability of books to feed the soul even in the darkest of times. When Death has a story to tell, you listen. It is 1939. Nazi Germany. The country is holding its breath. Death has never been ...', 'real_043.jpg', 1, 2007, 'English', 578, 'Knopf Books for Young Readers'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Book Thief' AND author = 'Markus Zusak');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Little Prince', 'Antoine de Saint-Exupéry', 135000, 'On one level this work is the story of an airman''s discovery of a small boy from another planet in the desert and his stories of intergalactic travel, and on the other hand it is a thought-provoking allegory of the human condition.', 'real_044.jpg', 1, 2018, 'English', 180, 'Wordsworth Editions'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Little Prince' AND author = 'Antoine de Saint-Exupéry');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Catcher in the Rye', 'J. D. Salinger', 142000, '''If you really want to hear about it, the first thing you''ll probably want to know is where I was born and what my lousy childhood was like, and how my parents were occupied and all before they had me, and all that David Copperfield kind of crap, but I don''t feel like going into it, if you want to know the truth.'' The first of J. D. Salinger''s four books to be published, The Catcher in the Rye is one of the most widely read and beloved of all ...', 'real_045.jpg', 1, 2019, 'English', 207, 'Penguin UK'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Catcher in the Rye' AND author = 'J. D. Salinger');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The old man and the sea', 'Ernest Hemingway', 107000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'real_046.jpg', 1, 1975, 'English', 68, 'Hueber Verlag'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The old man and the sea' AND author = 'Ernest Hemingway');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Crime and Punishment', 'Fyodor Dostoyevsky', 289000, 'Could an ordinary person, with no hint of malice and no motive but discovering what it feels like to do it, plot to kill and then actually murder a total stranger? What if the stranger were a thoroughly unlikable person hated by everyone who came into contact with her? One of the great novels of world literature, Crime and Punishment is a thriller of the conscience, one that wrangles with morality and its uses-or lack thereof-in the depths of ...', 'real_047.jpg', 1, 2008, 'English', 1090, 'Cosimo, Inc.'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Crime and Punishment' AND author = 'Fyodor Dostoyevsky');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Brothers Karamazov By Fyodor Dostoyevsky', 'Fyodor Dostoevsky', 289000, 'Không có mô tả chi tiết từ nguồn dữ liệu.', 'book1.jpg', 1, 1968, 'English', 821, 'Kiddy Monster Publication'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Brothers Karamazov By Fyodor Dostoyevsky' AND author = 'Fyodor Dostoevsky');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Anna Karenina', 'Leo Tolstoy', 289000, 'Widely considered one of the best novels ever written, Anna Karenina is the tragic story of the aristocratic Anna’s doomed affair with the wealthy Count Vronsky. Reflecting Russian morals of the time, as well as Tolstoy’s personal feelings on infidelity, Anna Karenina explores themes of passion and fidelity, the impact that social norms have on personal choice, and the ramifications of choosing a life outside of that deemed acceptable by socie...', 'real_049.jpg', 1, 2013, 'English', 1375, 'Harper Collins'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Anna Karenina' AND author = 'Leo Tolstoy');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Hobbit', 'J.R.R. Tolkien', 132000, 'This beautiful gift edition of The Hobbit, J.R.R. Tolkien''s classic prelude to his Lord of the Rings trilogy, features cover art, illustrations, and watercolor paintings by the artist Alan Lee. Bilbo Baggins is a hobbit who enjoys a comfortable, unambitious life, rarely traveling any farther than his pantry or cellar. But his contentment is disturbed when the wizard Gandalf and a company of dwarves arrive on his doorstep one day to whisk him a...', 'real_050.jpg', 1, 2012, 'English', 167, 'HarperCollins'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Hobbit' AND author = 'J.R.R. Tolkien');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Lord Of The Rings', 'J.R.R. Tolkien', 289000, 'Immerse yourself in Middle-earth with J.R.R. Tolkien’s classic masterpieces behind the films... This special 50th anniversary edition includes three volumes of The Lord of the Rings (The Fellowship of the Ring, The Two Towers, and The Return of the King), along with an extensive new index—a must-own tome for old and new Tolkien readers alike. One Ring to rule them all, One Ring to find them, One Ring to bring them all and in the darkness bind ...', 'real_051.jpg', 1, 2012, 'English', 1267, 'HarperCollins'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Lord Of The Rings' AND author = 'J.R.R. Tolkien');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Frank Herbert''s Dune Saga Collection: Books 1 - 6', 'Frank Herbert', 265000, 'Perfect for longtime fans and new readers alike—this eBook collection includes all six original novels in the Dune Saga written by Frank Herbert. In the far future, on a remote planet, an epic adventure awaits. Here are the first six novels of Frank Herbert’s magnificent Dune saga—a triumph of the imagination and one of the bestselling science fiction series of all time. The Dune Saga begins on the desert planet Arrakis with the story of the b...', 'real_052.jpg', 1, 2020, 'English', 700, 'Penguin'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Frank Herbert''s Dune Saga Collection: Books 1 - 6' AND author = 'Frank Herbert');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Foundation', 'Isaac Asimov', 154000, 'The first novel in Isaac Asimov’s classic science-fiction masterpiece, the Foundation series THE EPIC SAGA THAT INSPIRED THE APPLE TV+ SERIES FOUNDATION • Nominated as one of America’s best-loved novels by PBS’s The Great American Read For twelve thousand years the Galactic Empire has ruled supreme. Now it is dying. But only Hari Seldon, creator of the revolutionary science of psychohistory, can see into the future—to a dark age of ignorance, ...', 'real_053.jpg', 1, 2004, 'English', 255, 'Spectra'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Foundation' AND author = 'Isaac Asimov');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Neuromancer', 'William Gibson', 174000, 'Winner of the Hugo, Nebula, and Philip K. Dick Awards, Neuromancer is a science fiction masterpiece—a classic that ranks as one of the twentieth century’s most potent visions of the future. Case was the sharpest data-thief in the matrix—until he crossed the wrong people and they crippled his nervous system, banishing him from cyberspace. Now a mysterious new employer has recruited him for a last-chance run at an unthinkably powerful artificial...', 'real_054.jpg', 1, 2000, 'English', 337, 'Penguin'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Neuromancer' AND author = 'William Gibson');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Martian', 'Andy Weir', 173000, '#1 NEW YORK TIMES BESTSELLER • NOW A MAJOR MOTION PICTURE A mission to Mars. A freak accident. One man’s struggle to survive. From the author of Project Hail Mary comes “a hugely entertaining novel that reads like a rocket ship afire” (Chicago Tribune). “Brilliant . . . a celebration of human ingenuity [and] the purest example of real-science sci-fi for many years . . . utterly compelling.”—The Wall Street Journal Six days ago, astronaut Mark ...', 'real_055.jpg', 1, 2014, 'English', 332, 'Ballantine Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Martian' AND author = 'Andy Weir');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Project Hail Mary (Movie Tie-In)', 'Andy Weir', 214000, 'THE #1 NEW YORK TIMES BESTSELLER FROM THE AUTHOR OF THE MARTIAN • Soon to be a major motion picture starring Ryan Gosling, directed by Phil Lord and Christopher Miller, with a screenplay by Drew Goddard A lone astronaut must save the earth from disaster in this “propulsive” (Entertainment Weekly), cinematic thriller full of suspense, humor, and fascinating science. HUGO AWARD FINALIST • ONE OF THE YEAR’S BEST BOOKS: Bill Gates, GatesNotes, New...', 'real_056.jpg', 1, 2025, 'English', 497, 'Random House'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Project Hail Mary (Movie Tie-In)' AND author = 'Andy Weir');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Name of the Wind', 'Patrick Rothfuss', 259000, 'Discover #1 New York Times-bestselling Patrick Rothfuss’ epic fantasy series, The Kingkiller Chronicle. “I just love the world of Patrick Rothfuss.” —Lin-Manuel Miranda OVER 1 MILLION COPIES SOLD! DAY ONE: THE NAME OF THE WIND My name is Kvothe. I have stolen princesses back from sleeping barrow kings. I burned down the town of Trebon. I have spent the night with Felurian and left with both my sanity and my life. I was expelled from the Univer...', 'real_057.jpg', 1, 2007, 'English', 674, 'Astra Publishing House'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Name of the Wind' AND author = 'Patrick Rothfuss');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Way of Kings', 'Brandon Sanderson', 289000, 'From #1 New York Times bestselling author Brandon Sanderson, The Way of Kings, Book One of the Stormlight Archive, begins an incredible new saga of epic proportion. Roshar is a world of stone and storms. Uncanny tempests of incredible power sweep across the rocky terrain so frequently that they have shaped ecology and civilization alike. Animals hide in shells, trees pull in branches, and grass retracts into the soilless ground. Cities are bui...', 'real_058.jpg', 1, 2010, 'English', 1008, 'Tor Books'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Way of Kings' AND author = 'Brandon Sanderson');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'Mistborn', 'Brandon Sanderson', 262000, 'Now with over 10 million copies sold, The Mistborn Series has the thrills of a heist story, the twistiness of political intrigue, and the epic scale of a landmark fantasy saga. Once, a hero arose to save the world. He failed. Ever since, the world has been a wasteland of ash and mist controlled by the immortal emperor known as the Lord Ruler. But hope survives. A new uprising is forming, one built around the ultimate caper, the cunning of a br...', 'real_059.jpg', 1, 2010, 'English', 686, 'Macmillan'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'Mistborn' AND author = 'Brandon Sanderson');

INSERT INTO books (title, author, price, description, image, category_id, publish_year, language, pages, publisher)
SELECT 'The Silent Patient', 'Alex Michaelides', 162000, '- THE RECORD-BREAKING, MULTIMILLION COPY GLOBAL BESTSELLER AND TIKTOK SENSATION - Discover the #1 New York Times and Sunday Times bestselling thriller with a jaw-dropping twist that everyone is talking about - as seen on TikTok. Soon to be a major film. Alicia Berenson lived a seemingly perfect life until one day six years ago. When she shot her husband in the head five times. Since then she hasn''t spoken a single word. It''s time to find out w...', 'real_060.jpg', 1, 2019, 'English', 286, 'Hachette UK'
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title = 'The Silent Patient' AND author = 'Alex Michaelides');

