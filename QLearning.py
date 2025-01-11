import numpy as np
import random

# Environment setup
grid_size = 4
actions = ["up", "down", "left", "right"]
q_table = np.zeros((grid_size, grid_size, len(actions)))  # Q-values for each state-action pair

# Rewards
rewards = np.full((grid_size, grid_size), -1)  # Default penalty for each step
rewards[3][3] = 10  # Reward point at (3, 3)

# Hyperparameters
alpha = 0.1  # Learning rate
gamma = 0.9  # Discount factor
epsilon = 0.2  # Exploration rate

# Q-learning algorithm
def get_next_action(state):
    if random.uniform(0, 1) < epsilon:
        return random.choice(range(len(actions)))  # Explore
    return np.argmax(q_table[state])  # Exploit

def get_next_state(state, action):
    x, y = state
    if actions[action] == "up" and y < grid_size - 1:
        y += 1
    elif actions[action] == "down" and y > 0:
        y -= 1
    elif actions[action] == "left" and x > 0:
        x -= 1
    elif actions[action] == "right" and x < grid_size - 1:
        x += 1
    return (x, y)

for episode in range(3):  # Three episodes
    state = (0, 0)  # Start position
    while state != (3, 3):
        action = get_next_action(state)
        next_state = get_next_state(state, action)
        reward = rewards[next_state]
        old_value = q_table[state][action]
        next_max = np.max(q_table[next_state])
        # Q-learning update
        q_table[state][action] = old_value + alpha * (reward + gamma * next_max - old_value)
        state = next_state

# Display learned policy
for x in range(grid_size):
    for y in range(grid_size):
        best_action = np.argmax(q_table[(x, y)])
        print(f"Best action at ({x}, {y}): {actions[best_action]}")
