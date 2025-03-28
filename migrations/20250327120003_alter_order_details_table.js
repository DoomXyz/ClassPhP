'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.changeColumn('order_details', 'product_id', {
      type: Sequelize.INTEGER,
      allowNull: false,
      references: {
        model: 'product',
        key: 'id'
      },
      onUpdate: 'CASCADE',
      onDelete: 'CASCADE'
    });
  },

  down: async (queryInterface, Sequelize) => {
    await queryInterface.changeColumn('order_details', 'product_id', {
      type: Sequelize.INTEGER,
      allowNull: false
    });
  }
};