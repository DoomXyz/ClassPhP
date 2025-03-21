'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('orders', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      name: {
        type: Sequelize.STRING(255), // VARCHAR(255)
        allowNull: false
      },
      phone: {
        type: Sequelize.STRING(20), // VARCHAR(20)
        allowNull: false
      },
      address: {
        type: Sequelize.TEXT, // TEXT
        allowNull: false
      },
      created_at: {
        type: Sequelize.DATE, // TIMESTAMP
        allowNull: false,
        defaultValue: Sequelize.fn('CURRENT_TIMESTAMP')
      },
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('orders');
  }
};