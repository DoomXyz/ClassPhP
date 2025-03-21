'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('users', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      account: {
        type: Sequelize.STRING(255), // VARCHAR(255)
        allowNull: false,
        unique: true                 // Ràng buộc UNIQUE cho tài khoản
      },
      username: {
        type: Sequelize.STRING(255), // VARCHAR(255)
        allowNull: false             // Tên hiển thị, không cho phép null
      },
      password: {
        type: Sequelize.STRING(255), // VARCHAR(255)
        allowNull: false
      },
      created_at: {
        type: Sequelize.DATE,        // TIMESTAMP
        allowNull: false,
        defaultValue: Sequelize.fn('CURRENT_TIMESTAMP')
      },
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('users');
  }
};