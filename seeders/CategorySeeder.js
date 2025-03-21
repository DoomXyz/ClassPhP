'use strict';

module.exports = {
    up: async (queryInterface, Sequelize) => {
        try {
            // Xóa dữ liệu cũ trong bảng category
            console.log('Xóa dữ liệu cũ trong bảng category...');
            await queryInterface.bulkDelete('category', null, {});
            console.log('Đã xóa dữ liệu cũ trong bảng category.');

            // Reset giá trị tự tăng của cột id
            console.log('Reset giá trị tự tăng của cột id trong bảng category...');
            await queryInterface.sequelize.query('ALTER TABLE category AUTO_INCREMENT = 1;');
            console.log('Đã reset giá trị tự tăng.');

            // Chèn dữ liệu mới
            console.log('Bắt đầu chèn dữ liệu vào bảng category...');
            await queryInterface.bulkInsert('category', [
                {
                    name: 'Điện thoại',
                    description: 'Các loại điện thoại thông minh hiện đại.',
                },
                {
                    name: 'Laptop',
                    description: 'Máy tính xách tay phục vụ công việc và giải trí.',
                },
                {
                    name: 'Phụ kiện',
                    description: 'Tai nghe, ốp lưng, sạc dự phòng, v.v.',
                },
                {
                    name: 'Máy tính bảng',
                    description: 'Thiết bị di động với màn hình lớn.',
                },
                {
                    name: 'Đồng hồ thông minh',
                    description: 'Đồng hồ thông minh với nhiều tính năng hiện đại.',
                },
            ], {});
            console.log('Đã chèn 5 bản ghi vào bảng category.');
        } catch (error) {
            console.error('Lỗi khi chạy CategorySeeder:', error);
            throw error;
        }
    },

    down: async (queryInterface, Sequelize) => {
        await queryInterface.bulkDelete('category', null, {});
    }
};