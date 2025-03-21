'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('order_details', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      order_id: {
        type: Sequelize.INTEGER,
        allowNull: false,
        references: {
          model: 'orders', // Tên bảng tham chiếu
          key: 'id'       // Cột tham chiếu
        },
        onUpdate: 'CASCADE',
        onDelete: 'CASCADE' // Xóa chi tiết đơn hàng nếu đơn hàng bị xóa
      },
      product_id: {
        type: Sequelize.INTEGER,
        allowNull: false
        // Nếu product_id cũng là khóa ngoại, bạn có thể thêm references tương tự
      },
      quantity: {
        type: Sequelize.INTEGER,
        allowNull: false
      },
      price: {
        type: Sequelize.DECIMAL(10, 2), // DECIMAL(10, 2)
        allowNull: false
      },
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('order_details');
  }
};