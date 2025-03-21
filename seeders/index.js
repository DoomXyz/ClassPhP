'use strict';

module.exports = {
    up: async (queryInterface, Sequelize) => {
        // Chạy seeder cho bảng category trước
        await require('./CategorySeeder').up(queryInterface, Sequelize);
        // Sau đó chạy seeder cho bảng product
        await require('./ProductSeeder').up(queryInterface, Sequelize);
    },

    down: async (queryInterface, Sequelize) => {
        // Xóa dữ liệu theo thứ tự ngược lại
        await require('./ProductSeeder').down(queryInterface, Sequelize);
        await require('./CategorySeeder').down(queryInterface, Sequelize);
    }
};