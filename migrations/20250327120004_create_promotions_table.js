'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('promotions', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      code: {
        type: Sequelize.STRING(50),
        allowNull: false,
        unique: true
      },
      discount: {
        type: Sequelize.DECIMAL(5, 2),
        allowNull: false
      },
      expiry_date: {
        type: Sequelize.DATEONLY,
        allowNull: true
      }
    });
  },

  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('promotions');
  }
};