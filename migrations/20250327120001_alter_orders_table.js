'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.addColumn('orders', 'user_id', {
      type: Sequelize.INTEGER,
      allowNull: true,
      references: {
        model: 'users',
        key: 'id'
      },
      onUpdate: 'CASCADE',
      onDelete: 'SET NULL'
    });

    await queryInterface.addColumn('orders', 'status', {
      type: Sequelize.STRING(20),
      allowNull: false,
      defaultValue: 'pending'
    });

    await queryInterface.addColumn('orders', 'payment_method', {
      type: Sequelize.STRING(20),
      allowNull: true
    });

    await queryInterface.addColumn('orders', 'total_price', {
      type: Sequelize.DECIMAL(10, 2),
      allowNull: false,
      defaultValue: 0.00
    });
  },

  down: async (queryInterface, Sequelize) => {
    await queryInterface.removeColumn('orders', 'user_id');
    await queryInterface.removeColumn('orders', 'status');
    await queryInterface.removeColumn('orders', 'payment_method');
    await queryInterface.removeColumn('orders', 'total_price');
  }
};