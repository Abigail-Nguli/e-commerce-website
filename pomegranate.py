from pomegranate import *

# Define Bayesian Network
child_age = DiscreteDistribution({'0-6 months': 0.5, '6-12 months': 0.5})
product_size = ConditionalProbabilityTable(
    [['0-6 months', 'Small', 0.8],
     ['0-6 months', 'Medium', 0.2],
     ['6-12 months', 'Medium', 0.7],
     ['6-12 months', 'Large', 0.3]], [child_age])

# Build the network
network = BayesianNetwork('Baby Clothes Recommendation')
network.add_states(child_age, product_size)
network.add_edge(child_age, product_size)
network.bake()

# Predict with new user data
user_data = ['0-6 months']
prediction = network.predict([[0.7, 0.3]])
print(f"Predicted product size: {prediction}")
