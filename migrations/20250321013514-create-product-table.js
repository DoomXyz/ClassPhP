'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('product', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      name: {
        type: Sequelize.STRING(100), // VARCHAR(100)
        allowNull: false
      },
      description: {
        type: Sequelize.TEXT, // TEXT
        allowNull: true
      },
      price: {
        type: Sequelize.DECIMAL(10, 2), // DECIMAL(10, 2)
        allowNull: false
      },
      image: {
        type: Sequelize.STRING(255), // VARCHAR(255)
        allowNull: true,
        defaultValue: null
      },
      category_id: {
        type: Sequelize.INTEGER,
        allowNull: true, // Trong SQL không có NOT NULL, nên để true
        references: {
          model: 'category', // Tên bảng tham chiếu
          key: 'id'         // Cột tham chiếu
        },
        onUpdate: 'CASCADE',
        onDelete: 'SET NULL' // Hành vi khi xóa category
      },
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('product');
  }
};