'use strict';

module.exports = {
    up: async (queryInterface, Sequelize) => {
        // Xóa dữ liệu cũ trong bảng product
        await queryInterface.bulkDelete('product', null, {});

        await queryInterface.bulkInsert('product', [
            // Thể loại: Điện thoại (category_id: 1)
            {
                name: 'iPhone 15 Pro Max',
                price: 34990000.00,
                description: 'Điện thoại iPhone 15 Pro Max với chip A17 Pro, camera 48MP, và thiết kế titan.',
                category_id: 1,
                image: '../uploads/iphone15promax.jpg',
            },
            {
                name: 'Samsung Galaxy S23 Ultra',
                price: 31990000.00,
                description: 'Điện thoại Samsung Galaxy S23 Ultra với camera 200MP, S Pen tích hợp.',
                category_id: 1,
                image: '../uploads/samsunggalaxys23ultra.jpg',
            },
            {
                name: 'Google Pixel 8 Pro',
                price: 25990000.00,
                description: 'Điện thoại Google Pixel 8 Pro với AI tiên tiến, camera chất lượng cao.',
                category_id: 1,
                image: '../uploads/googlepixel8pro.jpg',
            },

            // Thể loại: Laptop (category_id: 2)
            {
                name: 'MacBook Pro M2 Max',
                price: 59990000.00,
                description: 'MacBook Pro 16 inch với chip M2 Max, hiệu năng vượt trội cho công việc chuyên nghiệp.',
                category_id: 2,
                image: '../uploads/macbookprom2max.jpg',
            },
            {
                name: 'Dell XPS 13',
                price: 39990000.00,
                description: 'Laptop Dell XPS 13 với màn hình OLED 13.4 inch, thiết kế mỏng nhẹ.',
                category_id: 2,
                image: '../uploads/dellxps13.jpg',
            },
            {
                name: 'ASUS ROG Zephyrus G14',
                price: 45990000.00,
                description: 'Laptop gaming ASUS ROG Zephyrus G14 với chip AMD Ryzen 9, card RTX 4060.',
                category_id: 2,
                image: '../uploads/asusrogzephyrusg14.jpg',
            },

            // Thể loại: Phụ kiện (category_id: 3)
            {
                name: 'Tai nghe Sony WH-1000XM5',
                price: 7990000.00,
                description: 'Tai nghe không dây Sony WH-1000XM5 với tính năng chống ồn hàng đầu.',
                category_id: 3,
                image: '../uploads/tainghesonywh1000xm5.jpg',
            },
            {
                name: 'Sạc dự phòng Anker 20000mAh',
                price: 1290000.00,
                description: 'Sạc dự phòng Anker 20000mAh với công nghệ sạc nhanh PowerIQ.',
                category_id: 3,
                image: '../uploads/sacduphonganker20000mah.jpg',
            },
            {
                name: 'Ốp lưng Spigen iPhone 15',
                price: 450000.00,
                description: 'Ốp lưng Spigen cho iPhone 15, chống sốc, thiết kế mỏng nhẹ.',
                category_id: 3,
                image: '../uploads/oplungspigeniphone15.jpg',
            },

            // Thể loại: Máy tính bảng (category_id: 4)
            {
                name: 'iPad Pro 12.9 M2',
                price: 31990000.00,
                description: 'iPad Pro 12.9 inch với chip M2, hỗ trợ Apple Pencil 2, màn hình Liquid Retina.',
                category_id: 4,
                image: '../uploads/ipadpro12.9m2.jpg',
            },
            {
                name: 'Samsung Galaxy Tab S9 Ultra',
                price: 27990000.00,
                description: 'Máy tính bảng Samsung Galaxy Tab S9 Ultra với màn hình AMOLED 14.6 inch.',
                category_id: 4,
                image: '../uploads/samsunggalaxytabs9ultra.jpg',
            },
            {
                name: 'Microsoft Surface Pro 9',
                price: 29990000.00,
                description: 'Microsoft Surface Pro 9 với chip Intel Core i7, có thể tháo rời bàn phím.',
                category_id: 4,
                image: '../uploads/microsoftsurfacepro9.jpg',
            },

            // Thể loại: Đồng hồ thông minh (category_id: 5)
            {
                name: 'Apple Watch Ultra 2',
                price: 21990000.00,
                description: 'Apple Watch Ultra 2 với thiết kế bền bỉ, hỗ trợ thể thao mạo hiểm.',
                category_id: 5,
                image: '../uploads/applewatchultra2.jpg',
            },
            {
                name: 'Samsung Galaxy Watch 6',
                price: 7990000.00,
                description: 'Samsung Galaxy Watch 6 với tính năng đo sức khỏe, màn hình AMOLED.',
                category_id: 5,
                image: '../uploads/samsunggalaxywatch6.jpg',
            },
            {
                name: 'Garmin Forerunner 965',
                price: 14990000.00,
                description: 'Đồng hồ Garmin Forerunner 965 chuyên dụng cho chạy bộ và thể thao.',
                category_id: 5,
                image: '../uploads/garminforerunner965.jpg',
            },
        ], {});
    },

    down: async (queryInterface, Sequelize) => {
        await queryInterface.bulkDelete('product', null, {});
    }
};