
import io
import base64
import sys

import pandas
import matplotlib.pyplot as plt, mpld3
from matplotlib.ticker import MultipleLocator

index_var = sys.argv[1]

f = open("index.html", "w")
f.write('Running Python')
f.close()

# print("Running Python" + index_var)
print("Running Python")